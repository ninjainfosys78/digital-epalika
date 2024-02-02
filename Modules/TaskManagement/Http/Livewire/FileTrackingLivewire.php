<?php

namespace Modules\TaskManagement\Http\Livewire;

use App\Models\Settings\Branch;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\TaskManagement\Entities\FileTracking;
use Modules\TaskManagement\Enums\FileStatusEnum as EnumsFileStatusEnum;

class FileTrackingLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['dateChanged'];

    public Collection $branches;
    public $users = [];

    public array $form = [
        'registration_no' => null,
        'is_hardcopy' => 1,
        'remarks' => null,
        'fileActivity' => [
            'assigned_branch_id' => null,
            'date_bs' => null,
            'date_ad' => null,
            'remarks' => null,
            'users' => []
        ],
        'fileTrackingFiles' => []
    ];

    public function mount()
    {
        $this->branches = Branch::with('branches')->whereNull('branch_id')->get();
    }

    public function addFileTrackingFiles()
    {
        $this->form['fileTrackingFiles'][] = [];
    }

    public function removeFileTrackingFile($index)
    {
        unset($this->form['fileTrackingFiles']);
        $this->form['fileTrackingFiles'] = array_values($this->form['fileTrackingFiles']);
    }

    public function dateChanged($nepaliDate, $englishDate)
    {
        $this->form['fileActivity']['date_bs'] = $nepaliDate;
        $this->form['fileActivity']['date_ad'] = $englishDate;
    }

    protected $rules = [
        'form.registration_no' => ['nullable', 'unique:file_trackings,registration_no'],
        'form.is_hardcopy' => ['nullable', 'boolean'],
        'form.fileActivity.date_bs' => ['required'],
        'form.fileActivity.assigned_branch_id' => ['required', 'exists:branches,id'],
        'form.fileActivity.remarks' => ['nullable'],
        'form.fileTrackingFiles' => ['nullable', 'array'],
        'form.fileTrackingFiles.*.title' => ['nullable', 'string', 'max:255'],
        'form.fileTrackingFiles.*.description' => ['nullable', 'string'],
        'form.fileTrackingFiles.*.files' => ['required', 'array'],
        'form.fileTrackingFiles.*.files.*' => ['mimes:jpg,jpeg,png,pdf'],
        'form.remarks' => ['nullable'],

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveFormData()
    {
        $this->validate();

        DB::transaction(function () {
            $fileTracking = FileTracking::create([
                'registration_no' => $this->form['registration_no'],
                'is_hardcopy' => $this->form['is_hardcopy'],
                'remarks' => $this->form['remarks'],
                'user_id' => auth()->id()
            ]);
            $fileActivity = $fileTracking->fileActivities()->create($this->form['fileActivity'] + [
                'assigned_by' => auth()->id(),
                'status' => EnumsFileStatusEnum::PENDING->value
            ]);
            $fileActivity->users()->attach(
                count($this->form['fileActivity']['users']) > 0 ? $this->form['fileActivity']['users'] : User::where('branch_id', $this->form['fileActivity']['assigned_branch_id'])->pluck('id')->toArray()
            );
            foreach ($this->form['fileTrackingFiles'] as $trackingFile) {
                $fileTrackingFile = $fileTracking->fileTrackingFiles()->create($trackingFile);
                foreach ($trackingFile['files'] ?? [] as $file) {
                    $fileTrackingFile->files()->create([
                        'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                        'extension' => $file->getClientOriginalExtension(),
                        'file' => $file->store('task_management/file_tracking', 'public'),
                    ]);
                }
            }
        });
        $this->reset('form');
        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => 'File Tracking Added Successfully'
        ]);
    }

    public function render()
    {
        if (!empty($this->form['fileActivity']['assigned_branch_id'])) {
            $this->users = User::where('branch_id', $this->form['fileActivity']['assigned_branch_id'])->get();
        }

        return view('taskmanagement::livewire.file-tracking-livewire');
    }
}
