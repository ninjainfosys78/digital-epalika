<?php

namespace Modules\TaskManagement\Http\Livewire;

use App\Models\Settings\Branch;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\TaskManagement\Entities\FileTracking;
use Modules\TaskManagement\Enums\FileStatusEnum;

class FileTransferLivewire extends Component
{
    use WithFileUploads;

    protected $listeners = ['dateChanged'];

    public Collection $branches;
    public $users = [];
    public FileTracking $fileTracking;

    public array $form = [
        'assigned_branch_id' => null,
        'date_bs' => null,
        'date_ad' => null,
        'is_received' => 0,
        'remarks' => null,
        'users' => []
    ];

    public function mount(FileTracking $fileTracking)
    {
        $this->branches = Branch::with('branches')->whereNull('branch_id')->get();
    }

    public function dateChanged($nepaliDate, $englishDate)
    {
        $this->form['date_bs'] = $nepaliDate;
        $this->form['date_ad'] = $englishDate;
    }

    protected $rules = [
        'form.date_bs' => ['required'],
        'form.is_received' => ['nullable', 'boolean'],
        'form.assigned_branch_id' => ['required', 'exists:branches,id'],
        'form.users' => ['nullable', 'array'],
        'form.users.*' => ['exists:users,id'],
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
            $fileActivity = $this->fileTracking->fileActivities()->create($this->form + [
                'assigned_by' => auth()->id(),
                'status' => FileStatusEnum::PENDING->value
            ]);
            $fileActivity->users()->attach(
                count($this->form['users']) > 0 ? $this->form['users'] : User::where('branch_id', $this->form['assigned_branch_id'])->pluck('id')->toArray()
            );
        });
        $this->reset('form');
        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => 'File Transferred Successfully'
        ]);
        return redirect(route('admin.taskManagement.fileTracking.show', $this->fileTracking));
    }

    public function render()
    {
        if (!empty($this->form['assigned_branch_id'])) {
            $this->users = User::where('branch_id', $this->form['assigned_branch_id'])->get();
        }

        return view('taskmanagement::livewire.file-transfer-livewire');
    }
}
