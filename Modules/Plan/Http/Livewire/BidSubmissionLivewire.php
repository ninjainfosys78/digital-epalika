<?php

namespace Modules\Plan\Http\Livewire;

use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Modules\Plan\Entities\Project;
use Modules\Plan\Entities\ProjectBidSubmission;
use Modules\Plan\Enums\BidSubmissionTypeEnum;

class BidSubmissionLivewire extends Component
{
    public bool $createModalOpened = false;
    public bool $editModalOpened = false;
    public Project $project;
    public ProjectBidSubmission $projectBidSubmission;

    public array $form = [
        'submission_type' => null,
        'submission_no' => null,
        'date' => null,
        'amount' => null
    ];

    protected $listeners = ['dateChanged'];

    public function mount($project)
    {
        $this->getProjectData($project);
    }

    public function dateChanged($nepaliDate, $englishDate)
    {
        $this->form['date'] = $nepaliDate;
    }

    public function create()
    {
        $this->createModalOpened = true;
    }

    public function edit(ProjectBidSubmission $projectBidSubmission)
    {
        $this->projectBidSubmission = $projectBidSubmission;
        $this->editModalOpened = true;
        foreach ($this->form as $key => $value) {
            $this->form[$key] = $projectBidSubmission[$key];
        }
    }

    public function closeModal()
    {
        $this->reset('form');
        $this->createModalOpened = false;
        $this->editModalOpened = false;
        $this->resetValidation();
    }

    public function getProjectData($project)
    {
        $this->project = $project->load('projectBidSubmissions');
    }

    public function rules(): array
    {
        return [
            'form.submission_type' => ['required', new Enum(BidSubmissionTypeEnum::class)],
            'form.submission_no' => ['required'],
            'form.date' => ['required'],
            'form.amount' => ['required', 'numeric']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->project->projectBidSubmissions()->create($this->validate()['form'] + [
                'fiscal_year_id' => officeSetting()->fiscal_year_id
            ]);
        $this->closeModal();
        $this->getProjectData($this->project);

        $this->toastMessage('विल विवरण सफलतापूर्वक थपियो');
    }

    public function update()
    {
        $this->projectBidSubmission->update($this->validate()['form']);
        $this->closeModal();
        $this->getProjectData($this->project);

        $this->toastMessage('विल विवरण सफलतापूर्वक अद्यावधिक गरियो');
    }

    public function delete(ProjectBidSubmission $projectBidSubmission)
    {
        $projectBidSubmission->delete();
        $this->getProjectData($this->project);

        $this->toastMessage('विल विवरण सफलतापूर्वक मेटाइयो');
    }

    public function toastMessage($title)
    {
        $this->dispatchBrowserEvent('toast_message', [
            'type' => 'success',
            'title' => $title,
        ]);
    }

    public function render()
    {
        return view('plan::livewire.bid-submission-livewire');
    }
}
