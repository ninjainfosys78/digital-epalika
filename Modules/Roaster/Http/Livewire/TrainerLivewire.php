<?php

namespace Modules\Roaster\Http\Livewire;

use App\Models\Address\Province;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use App\Traits\AddressHelperTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Roaster\Entities\Subject;
use Modules\Roaster\Traits\helpers\TrainerHelperTrait;

class TrainerLivewire extends Component
{
    use TrainerHelperTrait;
    use WithFileUploads;
    use AddressHelperTrait;

    public $designations = [];

    public $departments = [];

    public $provinces = [];

    public $subjects = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = [];

    public $trainer;

    public $form = [
        'name' => null,
        'designation_id' => null,
        'department_id' => null,
        'level' => null,
        'phone' => null,
        'email' => null,
        'pan' => null,
        'province_id' => null,
        'district_id' => null,
        'local_body_id' => null,
        'ward' => null,
        'tole' => null,
        'office' => null,
        'appointment_date' => null,
        'experience' => null,
        'qualification' => null,
        'bank_detail' => null,
        'experience_as_trainee' => null,
        'experience_as_trainer' => null,
        'subject_ids' => [],
        'workExperiences' => [],
        'qualifications' => [],
        'experienceAsTrainees' => [],
        'experienceAsTrainers' => [],
        'bankDetails' => [],
        'documents' => [],
    ];

    public function mount($trainer = null): void
    {
        $this->trainer = $trainer;

        $this->designations = Designation::all();
        $this->departments = Department::all();
        $this->provinces = Province::all();
        $this->subjects = Subject::latest()->get();

        if (!empty($trainer)) {
            $this->setDataForEdit($trainer);
        }
    }

    public function render(): Factory|View|Application
    {
        $this->getDependentAddressData();

        return view('roaster::livewire.trainer-livewire');
    }

    private function setDataForEdit($trainer): void
    {
        foreach ($this->form as $key => $data) {
            if (array_key_exists($key, $trainer->toArray())) {
                $this->form[$key] = $trainer[$key];
            }
        }
        //work experiences
        foreach ($trainer->trainerExperiences as $workExperience) {
            $this->form['workExperiences'][] = [
                'id' => $workExperience->id,
                'office' => $workExperience->office,
                'designation_id' => $workExperience->designation_id,
                'responsibility' => $workExperience->responsibility,
                'from' => $workExperience->from,
                'to' => $workExperience->to,
                'remarks' => $workExperience->remarks,
            ];
        }
        //documents
        foreach ($trainer->trainerDocuments as $document) {
            $this->form['documents'][] = [
                'id' => $document->id,
                'title' => $document->title,
            ];
        }
        //bank details
        foreach ($trainer->trainerBankDetails as $bankDetail) {
            $this->form['bankDetails'][] = [
                'id' => $bankDetail->id,
                'bank_name' => $bankDetail->bank_name,
                'bank_branch' => $bankDetail->bank_branch,
                'account_number' => $bankDetail->account_number,
                'account_holder' => $bankDetail->account_holder,
            ];
        }
        //education qualifications
        foreach ($trainer->trainerQualifications as $qualification) {
            $this->form['qualifications'][] = [
                'id' => $qualification->id,
                'achievement' => $qualification->achievement,
                'institute' => $qualification->institute,
                'passed_year' => $qualification->passed_year,
                'major_subjects' => $qualification->major_subjects,
                'remarks' => $qualification->remarks,
            ];
        }
        //trainer as trainee experience
        foreach ($trainer->trainerExperienceAsTrainees as $experienceAsTrainee) {
            $this->form['experienceAsTrainees'][] = [
                'id' => $experienceAsTrainee->id,
                'subject' => $experienceAsTrainee->subject,
                'provider' => $experienceAsTrainee->provider,
                'duration' => $experienceAsTrainee->duration,
                'venue' => $experienceAsTrainee->venue,
            ];
        }
        //as trainer experience
        foreach ($trainer->trainerExperienceInTrainings as $trainerExperienceInTraining) {
            $this->form['experienceAsTrainers'][] = [
                'id' => $trainerExperienceInTraining->id,
                'sector' => $trainerExperienceInTraining->sector,
                'subject' => $trainerExperienceInTraining->subject,
                'organization' => $trainerExperienceInTraining->organization,
                'training_level' => $trainerExperienceInTraining->training_level,
                'training_time' => $trainerExperienceInTraining->training_time,
                'remarks' => $trainerExperienceInTraining->remarks,
            ];
        }
        //subjects
        $this->form['subject_ids'] = $trainer->subjects->pluck('id');
    }
}
