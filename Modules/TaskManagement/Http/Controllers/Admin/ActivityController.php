<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\Branch;
use App\Models\User;
use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TaskManagement\Entities\Activity;
use Modules\TaskManagement\Entities\ActivityList;
use Modules\TaskManagement\Http\Requests\Activity\StoreActivityRequest;
use Modules\TaskManagement\Http\Requests\Activity\UpdateActivityRequest;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ActivityController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $this->checkAuthorization('taskActivity_access');

        $activities = Activity::with('branch', 'activityLists')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(50);

        return view('taskmanagement::admin.activity.index', compact('activities'));
    }

    public function create()
    {
        $this->checkAuthorization('taskActivity_create');

        return view('taskmanagement::admin.activity.create');
    }

    public function store(StoreActivityRequest $request)
    {
        $this->checkAuthorization('taskActivity_create');

        DB::transaction(function () use ($request) {
            $activity = Activity::create($request->validated() + [
                'user_id' => auth()->id(),
                'branch_id' => auth()->user()->branch_id,
                'fiscal_year_id' => officeSetting()->fiscal_year_id
            ]);
            $activity->assignedTasks()->create([
                'assigned_user_id' => auth()->id(),
                'create_user_id' => auth()->id(),
                'created_by' => auth()->user()->name
            ]);

            foreach ($request->validated()['activity_lists'] as $list) {
                $activityList = $activity->activityLists()->create($list);
                if (!empty($list['documents'])) {
                    $this->uploadDocuments($list['documents'], $activityList);
                }
            }
        });

        toast('आजको गतिविधि सफलतापूर्वक थपियो', 'success');
        return back();
    }


    public function show(Activity $activity)
    {
        $this->checkAuthorization('taskActivity_access');

        $activity->load('activityLists.files', 'assignedTasks.assignedUser', 'assignedTasks.files');
        $users = User::whereNot('id', auth()->id())->get();

        return view('taskmanagement::admin.activity.show', compact('activity', 'users'));
    }

    public function edit(Activity $activity)
    {
        $this->checkAuthorization('taskActivity_edit');

        $activity->load('activityLists.files');

        return view('taskmanagement::admin.activity.edit', compact('activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $this->checkAuthorization('taskActivity_edit');

        DB::transaction(function () use ($request, $activity) {
            $activity->update($request->validated());

            foreach ($request->validated()['activity_lists'] as $list) {
                $activityList = ActivityList::updateOrCreate(
                    ['activity_id' => $activity->id, 'id' => $list['id']] ?? null,
                    $list
                );

                if (!empty($list['documents'])) {
                    $this->uploadDocuments($list['documents'], $activityList);
                }
            }
            $activity->activityLists()->whereNotIn('id', Arr::pluck($request->input('activity_lists'), 'id'))->delete();
        });

        toast('सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.taskManagement.activity.index'));
    }


    public function destroy(Activity $activity)
    {
        $this->checkAuthorization('taskActivity_delete');

        $activity->load('activityLists');
        foreach ($activity->activityLists as $activityList) {
            $activityList->files()->delete();
        }
        $activity->activityLists()->delete();
        $activity->delete();
        toast('सफलतापूर्वक हटाइयो', 'success');
        return back();
    }

    private function uploadDocuments($documents, $activityList)
    {
        foreach ($documents as $document) {
            $activityList->files()->create([
                'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $document->getClientOriginalExtension(),
                'file' => $document->store('task_management/' . Str::slug($activityList->title, '_'), 'public'),
            ]);
        }
    }

    public function assignTask(Request $request, Activity $activity)
    {
        $formData = $request->validate([
            'assigned_user_id' => ['required', Rule::exists('users', 'id')->withoutTrashed()],
            'files' => ['nullable', 'array'],
            'files.*.file_name' => ['nullable', 'string', 'max:255'],
            'files.*.file' => ['required', 'mimes:png,jpg,pdf']
        ]);

        DB::transaction(function () use ($request, $formData, $activity) {
            $assignedTask = $activity->assignedTasks()->create([
                'assigned_user_id' => $request->input('assigned_user_id'),
                'create_user_id' => auth()->id(),
                'created_by' => auth()->user()->name
            ]);
            foreach ($formData['files'] ?? [] as $file) {
                $assignedTask->files()->create([
                    'file_name' => $file['file_name'] ?? pathinfo($file['file']->getClientOriginalName(), PATHINFO_FILENAME),
                    'extension' => $file['file']->getClientOriginalExtension(),
                    'file' => $file['file']->store('task_management/files', 'public'),
                ]);
            }
        });

        toast('Task Assigned Successfully', 'success');

        return back();
    }

    public function excelImportPage(Request $request)
    {
        $this->checkAuthorization('taskActivity_create');

        $branches = Branch::with('branches')->whereNull('branch_id')->get();
        $users = User::all();

        return view('taskmanagement::admin.activity.import', compact('users', 'branches'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => ['required', 'mimes:xlsx'],
            'user_id' => [Rule::requiredIf(auth()->user()->role->type == 'Super')],
            'branch_id' => [Rule::requiredIf(auth()->user()->role->type == 'Super')],
        ]);

        $excelData = $this->processExcelData($request->file('excel_file'));

        foreach ($excelData as $formData) {
            $activity = Activity::create([
                'date' => $this->excelDateToDate($formData['date']),
                'date_en' => $this->bsToAdDate($this->excelDateToDate($formData['date'])),
                'user_id' => $request->input('user_id') ?? auth()->id(),
                'branch_id' => $request->input('branch_id') ?? auth()->user()->branch_id,
                'fiscal_year_id' => officeSetting()->fiscal_year_id,
                'remarks' => $formData['remarks'] ?? null
            ]);

            foreach ($formData['activities'] as $activityData) {
                $activity->activityLists()->create([
                    'title' => $activityData['title'],
                    'description' => $activityData['description'],
                    'remarks' => $activityData['remarks'],
                ]);
            }
        }

        toast('कार्यहरु सफलतापुर्बक अपलोड गरियो', 'success');
        return back();
    }

    private function processExcelData($file)
    {
        $data = Excel::toArray([], $file);
        $processedData = [];
        // Access and process data from each sheet
        foreach ($data as $index => $sheetData) {
            $header = $sheetData[0];
            $sheetData = array_slice($sheetData, 1);

            // Assign the processed data to the corresponding key in the processedData array
            $processedData["sheet" . ($index + 1)] = [];

            // Process the data from the sheet
            foreach ($sheetData as $row) {
                // Create an associative array using the header as the key
                $rowData = array_combine($header, $row);

                // Add the processed row data to the sheet's processed data array
                $processedData["sheet" . ($index + 1)][] = $rowData;
            }
        }

        $sheet1Data = $processedData['sheet1'];
        $sheet2Data = $processedData['sheet2'];

        $mergedData = [];

        foreach ($sheet1Data as $sheet1Row) {
            $sn = $sheet1Row['sn'];

            $sheet1Row['activities'] = [];

            foreach ($sheet2Data as $sheet2Row) {
                if ($sheet2Row['task_sn'] == $sn) {
                    $sheet1Row['activities'][] = $sheet2Row;
                }
            }

            $mergedData[] = $sheet1Row;
        }

        $processedData['sheet1'] = $mergedData;

        return $mergedData;
    }

    private function excelDateToDate($date): string
    {
        return Carbon::instance(Date::excelToDateTimeObject($date))->toDateString();
    }
}
