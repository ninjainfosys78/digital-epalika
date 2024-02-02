<?php

namespace Modules\TaskManagement\Http\Livewire;

use App\Traits\NepaliDateConverter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\TaskManagement\Entities\Activity;
use Modules\TaskManagement\Enums\ActivityTypeEnum;

class ActivityLivewire extends Component
{
    use WithFileUploads;
    use NepaliDateConverter;

    protected $listeners = ['dateChanged'];

    public array $months;
    public Collection $monthRanges;

    public $form = [
        'date' => '',
        'date_en' => '',
        'remarks' => '',
        'activity_type' => ActivityTypeEnum::DAILY,
        'month_range' => '',
        'activity_lists' => [
            [
                'title' => '',
                'description' => '',
                'remarks' => '',
            ]
        ]
    ];

    public Activity $DbActivity;

    public function mount($dbActivity = null)
    {
        $this->months = $this->month_name;

        if (!empty($dbActivity)) {
            $this->DbActivity = $dbActivity;
            $this->form['date'] = $dbActivity->date;
            $this->form['date_en'] = $dbActivity->date_en?->toDateString();
            $this->form['remarks'] = $dbActivity->remarks;
            $this->form['activity_type'] = $dbActivity->activity_type?->value;
            $this->form['month_range'] = $dbActivity->month_range ?? null;
            $list = [];
            foreach ($dbActivity->activityLists as $activityList) {
                $list[] = [
                    'id' => $activityList->id,
                    'title' => $activityList->title,
                    'description' => $activityList->description,
                    'remarks' => $activityList->remarks,
                ];
            }
            $this->form['activity_lists'] = $list;
        }
    }

    public function dateChanged($nepaliDate, $englishDate)
    {
        $this->form['date'] = $nepaliDate;
        $this->form['date_en'] = $englishDate;
    }

    public function addActivity()
    {
        $this->form['activity_lists'][] = [
            'title' => '',
            'description' => '',
            'remarks' => '',
        ];
    }

    protected $rules = [
        'form.date' => ['required_if:form.activity_type,daily'],
        'form.date_en' => ['required_if:form.activity_type,daily'],
        'form.activity_type' => ['required'],
        'form.month_range' => ['required_if:form.activity_type,monthly'],
        'form.activity_lists' => ['required', 'array'],
        'form.activity_lists.*.title' => ['required', 'string', 'max:255'],
        'form.activity_lists.*.description' => ['nullable'],
        'form.activity_lists.*.remarks' => ['nullable'],
        'form.activity_lists.*.documents' => ['nullable', 'array'],
        'form.activity_lists.*.documents.*' => ['file'],
        'form.remarks' => ['nullable'],

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            if (!empty($this->DbActivity)) {
                $this->DbActivity->update([
                    'date' => $this->form['activity_type'] == 'daily' ? $this->form['date'] : null,
                    'date_en' => $this->form['activity_type'] == 'daily' ? $this->form['date_en'] : null,
                    'remarks' => $this->form['remarks'] ?? null,
                    'activity_type' => $this->form['activity_type'],
                    'month_range' => in_array($this->form['activity_type'], ['monthly', 'tri_monthly', 'quarterly']) ? $this->form['month_range'] : null
                ]);
            } else {
                $this->DbActivity = Activity::create([
                    'date' => $this->form['activity_type'] == 'daily' ? $this->form['date'] : null,
                    'date_en' => $this->form['activity_type'] == 'daily' ? $this->form['date_en'] : null,
                    'user_id' => auth()->id(),
                    'branch_id' => auth()->user()->branch_id,
                    'fiscal_year_id' => officeSetting()->fiscal_year_id,
                    'remarks' => $this->form['remarks'] ?? null,
                    'activity_type' => $this->form['activity_type'],
                    'month_range' => in_array($this->form['activity_type'], ['monthly', 'tri_monthly', 'quarterly']) ? $this->form['month_range'] : null
                ]);
                $this->DbActivity->assignedTasks()->create([
                    'assigned_user_id' => auth()->id(),
                    'create_user_id' => auth()->id(),
                    'created_by' => auth()->user()->name
                ]);
            }

            foreach ($this->form['activity_lists'] as $activityList) {
                if (isset($activityList['id'])) {
                    $createdActivityList = $this->DbActivity->activityLists()->find($activityList['id']);
                    $createdActivityList->update($activityList);
                } else {
                    $createdActivityList = $this->DbActivity->activityLists()->create($activityList);
                }

                if (!empty($activityList['documents'])) {
                    $this->uploadDocuments($activityList['documents'], $createdActivityList);
                }
            }
        });

        $this->reset('form');
        toast("Activity " . (!empty($this->DbActivity) ? 'Updated' : 'Created') . "Successfully", 'success');
        return redirect()->route('admin.taskManagement.activity.index');
    }

    public function removeActivity($index)
    {
        $data = $this->form['activity_lists'][$index];

        if (isset($data['id'])) {
            $activityList = $this->DbActivity->activityLists()->find($data['id']);
            if (!empty($activityList)) {
                $activityList->files()->delete();
                $activityList->delete();
            }
        }
        unset($this->form['activity_lists'][$index]);

        $this->form['activity_lists'] = array_values($this->form['activity_lists']);
    }

    private function uploadDocuments($documents, $createdActivityList)
    {
        foreach ($documents as $document) {
            $createdActivityList->files()->create([
                'file_name' => pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $document->getClientOriginalExtension(),
                'file' => $document->store('task-management/' . Str::slug($createdActivityList->title, '_'), 'public'),
            ]);
        }
    }

    public function render()
    {
        if (!empty($this->form['activity_type'])) {
            if ($this->form['activity_type'] == 'tri_monthly') {
                $this->monthRanges = $this->triMonthlyQuarters();
            } elseif ($this->form['activity_type'] == 'quarterly') {
                $this->monthRanges = $this->quarters();
            }
        }

        return view('taskmanagement::livewire.activity-livewire');
    }
}
