<?php

namespace Modules\Roaster\Traits\helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Roaster\Entities\Trainer;
use Modules\Roaster\Entities\TrainerBankDetail;
use Modules\Roaster\Entities\TrainerDocument;
use Modules\Roaster\Entities\TrainerExperience;
use Modules\Roaster\Entities\TrainerExperienceAsTrainee;
use Modules\Roaster\Entities\TrainerExperienceInTraining;
use Modules\Roaster\Entities\TrainerQualification;

trait TrainerHelperTrait
{
    public function addColumnToWorkExperienceArray(): void
    {
        $this->form['workExperiences'][] = [];
    }

    public function removeColumnFromWorkExperienceArray($index): void
    {
        unset($this->form['workExperiences'][$index]);
        $this->form['workExperiences'] = array_values($this->form['workExperiences']);
    }

    public function addColumnToBankDetailArray(): void
    {
        $this->form['bankDetails'][] = [];
    }

    public function removeColumnFromBankDetailArray($index): void
    {
        unset($this->form['bankDetails'][$index]);
        $this->form['bankDetails'] = array_values($this->form['bankDetails']);
    }

    public function addColumnToDocumentArray(): void
    {
        $this->form['documents'][] = [];
    }

    public function removeColumnFromDocumentArray($index): void
    {
        unset($this->form['documents'][$index]);
        $this->form['documents'] = array_values($this->form['documents']);
    }

    public function addColumnToQualificationArray(): void
    {
        $this->form['qualifications'][] = [];
    }

    public function removeColumnFromQualificationArray($index): void
    {
        unset($this->form['qualifications'][$index]);
        $this->form['qualifications'] = array_values($this->form['qualifications']);
    }

    public function addColumnToExperienceAsTraineeArray(): void
    {
        $this->form['experienceAsTrainees'][] = [];
    }

    public function removeColumnFromExperienceAsTraineeArray($index): void
    {
        unset($this->form['experienceAsTrainees'][$index]);
        $this->form['experienceAsTrainees'] = array_values($this->form['experienceAsTrainees']);
    }

    public function addColumnToExperienceAsTrainerArray(): void
    {
        $this->form['experienceAsTrainers'][] = [];
    }

    public function removeColumnFromExperienceAsTrainerArray($index): void
    {
        unset($this->form['experienceAsTrainers'][$index]);
        $this->form['experienceAsTrainers'] = array_values($this->form['experienceAsTrainers']);
    }

    public function rules(): array
    {
        if (empty($this->trainer)) {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['required', 'image', 'max:300'],
                'form.documents.*.document' => ['required', 'file'],
            ]);
        } else {
            $this->validationRules = array_merge($this->validationRules, [
                'form.photo' => ['nullable', 'image', 'max:300'],
                'form.documents.*.document' => ['nullable', 'file'],
            ]);
        }

        $this->mergeBankDetailValidation();
        $this->mergeWorkExperienceValidation();
        $this->mergeQualificationsValidation();
        $this->mergeExperienceAsTraineeValidation();
        $this->mergeExperienceAsTrainerValidation();
        $this->mergeDocumentsValidation();

        return $this->validationRules;
    }

    protected function mergeBankDetailValidation(): array
    {
        if (config('trainer.status.bankDetailForm')) {
            if (config('trainer.type.bankDetailForm') === 'compact') {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.bank_detail' => ['nullable'],
                ]);
            } else {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.bankDetails' => ['nullable', 'array'],
                    'form.bankDetails.*.bank_name' => ['required'],
                    'form.bankDetails.*.bank_branch' => ['required'],
                    'form.bankDetails.*.account_number' => ['required'],
                    'form.bankDetails.*.account_holder' => ['required'],
                ]);
            }

            return $this->validationRules;
        }

        return [];
    }

    protected function mergeWorkExperienceValidation(): array
    {
        if (config('trainer.status.experienceForm')) {
            if (config('trainer.type.experienceForm') === 'compact') {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.experience' => ['required'],
                ]);
            } else {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.workExperiences' => ['nullable', 'array'],
                    'form.workExperiences.*.office' => ['required'],
                    'form.workExperiences.*.designation_id' => ['required', 'exists:designations,id'],
                    'form.workExperiences.*.responsibility' => ['required'],
                    'form.workExperiences.*.from' => ['required', 'date_format:Y-m-d'],
                    'form.workExperiences.*.to' => ['nullable', 'date_format:Y-m-d'],
                    'form.workExperiences.*.remarks' => ['nullable'],
                ]);
            }

            return $this->validationRules;
        }

        return [];
    }

    protected function mergeQualificationsValidation(): array
    {
        if (config('trainer.status.qualificationForm')) {
            if (config('trainer.type.qualificationForm') === 'compact') {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.qualification' => ['required'],
                ]);
            } else {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.qualifications' => ['nullable', 'array'],
                    'form.qualifications.*.achievement' => ['required'],
                    'form.qualifications.*.institute' => ['required'],
                    'form.qualifications.*.passed_year' => ['nullable'],
                    'form.qualifications.*.major_subjects' => ['nullable'],
                    'form.qualifications.*.remarks' => ['nullable'],
                ]);
            }

            return $this->validationRules;
        }

        return [];
    }

    protected function mergeExperienceAsTraineeValidation(): array
    {
        if (config('trainer.status.experienceAsTraineeForm')) {
            if (config('trainer.type.experienceAsTraineeForm') === 'compact') {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.experience_as_trainee' => ['nullable'],
                ]);
            } else {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.experienceAsTrainees' => ['nullable', 'array'],
                    'form.experienceAsTrainees.*.subject' => ['required'],
                    'form.experienceAsTrainees.*.provider' => ['required'],
                    'form.experienceAsTrainees.*.duration' => ['required'],
                    'form.experienceAsTrainees.*.venue' => ['required'],
                ]);
            }

            return $this->validationRules;
        }

        return [];
    }

    protected function mergeExperienceAsTrainerValidation(): array
    {
        if (config('trainer.status.experienceAsTrainerForm')) {
            if (config('trainer.type.experienceAsTrainerForm') === 'compact') {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.experience_as_trainer' => ['nullable'],
                ]);
            } else {
                $this->validationRules = array_merge($this->validationRules, [
                    'form.experienceAsTrainers' => ['nullable', 'array'],
                    'form.experienceAsTrainers.*.sector' => ['required'],
                    'form.experienceAsTrainers.*.subject' => ['required'],
                    'form.experienceAsTrainers.*.organization' => ['required'],
                    'form.experienceAsTrainers.*.training_level' => ['required'],
                    'form.experienceAsTrainers.*.training_time' => ['required'],
                    'form.experienceAsTrainers.*.remarks' => ['nullable'],
                ]);
            }

            return $this->validationRules;
        }

        return [];
    }

    protected function mergeDocumentsValidation(): array
    {
        if (config('trainer.status.otherDocumentForm')) {
            $this->validationRules = array_merge($this->validationRules, [
                'form.documents' => ['nullable', 'array'],
                'form.documents.*.title' => ['required'],
            ]);

            return $this->validationRules;
        }

        return [];
    }

    protected array $validationRules = [
        'form.name' => ['required'],
        'form.designation_id' => ['required', 'exists:designations,id'],
        'form.department_id' => ['required', 'exists:departments,id'],
        'form.level' => ['nullable'],
        'form.phone' => ['required', 'regex:/^([0-9,]*)$/'],
        'form.email' => ['required', 'email', 'unique:users,email'],
        'form.pan' => ['nullable'],
        'form.province_id' => ['required', 'exists:provinces,id'],
        'form.district_id' => ['required', 'exists:districts,id'],
        'form.local_body_id' => ['required', 'exists:local_bodies,id'],
        'form.ward' => ['required'],
        'form.tole' => ['nullable'],
        'form.office' => ['required'],
        'form.appointment_date' => ['nullable', 'date_format:Y-m-d'],
        'form.subject_ids' => ['required', 'array'],
        'form.subject_ids.*' => ['exists:subjects,id'],
    ];

    //real time validation

    /**
     * @throws ValidationException
     */
    public function updated($fields): void
    {
        $this->validateOnly($fields, $this->rules());
    }

    protected array $messages = [
        'form.name.required' => 'पूरा नाम आवश्यक छ ।',
        'form.designation_id.required' => 'पद आवश्यक छ ।',
        'form.department_id.required' => 'सेवा समुह आवश्यक छ ।',
        'form.email.required' => 'इमेल आवश्यक छ ।',
        'form.phone.required' => 'फोन नम्बर आवश्यक छ ।',
        'form.phone.regex' => 'फोन नम्बर 98XXXX,98XXXX ।',
        'form.level.required' => 'तह आवश्यक छ ।',
        'form.pan.required' => 'स्थायी लेखा नम्बर आवश्यक छ ।',
        'form.province_id.required' => 'प्रदेश आवश्यक छ ।',
        'form.district_id.required' => 'जिल्ला आवश्यक छ ।',
        'form.local_body_id.required' => 'स्थानीय निकाय आवश्यक छ ।',
        'form.ward.required' => 'वार्ड नम्बर आवश्यक छ ।',
        'form.tole.required' => 'टोल आवश्यक छ ।',
        'form.photo.required' => 'फोटो आवश्यक छ ।',
        'form.office.required' => 'हाल कार्यरत कार्यालयको नाम र ठेगाना आवश्यक छ ।',
        'form.experience.required' => 'कार्य अनुभव (बर्ष) आवश्यक छ ।',
        'form.qualification.required' => 'शैक्षिक योग्यता  आवश्यक छ ।',
        'form.bank_detail.required' => 'बैंक खाता आवश्यक छ ।',
        'form.experience_as_trainee.required' => 'संलग्न तालिमको विवरण आवश्यक छ ।',
        'form.experience_as_trainer.required' => 'तालिममा प्रशिक्षक भएको अनुभव आवश्यक छ ।',
        'form.subject_ids.required' => 'बिषय विज्ञता आवश्यक छ ।',
        'form.bankDetails.*.bank_name.required' => 'बैंकको नाम आवश्यक छ ।',
        'form.bankDetails.*.bank_branch.required' => 'शाखाको नाम आवश्यक छ ।',
        'form.bankDetails.*.account_number.required' => 'खाता नं. आवश्यक छ ।',
        'form.bankDetails.*.account_holder.required' => 'खाता वालाको नाम आवश्यक छ ।',
        'form.qualifications.*.achievement.required' => 'शैक्षिक तह आवश्यक छ ।',
        'form.qualifications.*.institute.required' => 'विश्वविद्यालय/शैक्षिक संस्था आवश्यक छ ।',
        'form.workExperiences.*.office.required' => 'कार्यालय/संस्था आवश्यक छ ।',
        'form.workExperiences.*.designation_id.required' => 'पद आवश्यक छ ।',
        'form.workExperiences.*.responsibility.required' => 'मुख्य जिम्मेवारी आवश्यक छ ।',
        'form.workExperiences.*.from.required' => 'मिति देखि आवश्यक छ ।',
        'form.documents.*.title.required' => 'मकागजातको नाम आवश्यक छ ।',
        'form.documents.*.document.required' => 'फाइल आवश्यक छ ।',
        'form.experienceAsTrainees.*.subject.required' => 'तालिमको विषय आवश्यक छ ।',
        'form.experienceAsTrainees.*.provider.required' => 'तालिम दिने निकाय आवश्यक छ ।',
        'form.experienceAsTrainees.*.duration.required' => 'तालिमको अवधि आवश्यक छ ।',
        'form.experienceAsTrainees.*.venue.required' => 'स्थान आवश्यक छ ।',
        'form.experienceAsTrainers.*.sector.required' => 'तालिमको क्षेत्र आवश्यक छ ।',
        'form.experienceAsTrainers.*.subject.required' => 'प्रशिक्षणको विषय आवश्यक छ ।',
        'form.experienceAsTrainers.*.organization.required' => 'तालिम दिने निकाय आवश्यक छ ।',
        'form.experienceAsTrainers.*.training_level.required' => 'सहभागीको स्तर आवश्यक छ ।',
        'form.experienceAsTrainers.*.training_time.required' => 'तालिमको अवधि आवश्यक छ ।',
    ];

    public function storeData(): void
    {
        $data = $this->validate()['form'];

        DB::transaction(function () use ($data) {
            if (!empty($this->trainer)) {
                $this->trainer->update($data);
                $this->saveArrayData($this->trainer, $this->form);
                $this->dispatchBrowserEvent('alert_message', [
                    'type' => 'success',
                    'title' => 'Thank You',
                    'text' => 'Trainer Data Updated Successfully',
                ]);

                return redirect(route('admin.roaster.trainer.index'));
            }

            $trainer = Trainer::create($data);
            $this->saveArrayData($trainer, $this->form);
            $this->reset('form');
            $this->dispatchBrowserEvent('alert_message', [
                'type' => 'success',
                'title' => 'Thank You',
                'text' => 'Your Form Submitted Successfully',
            ]);
        });
    }

    public function saveArrayData($trainer, $data): void
    {
        // bank details
        if (config('trainer.status.bankDetailForm') && config('trainer.type.bankDetailForm') === 'extended') {
            foreach ($data['bankDetails'] as $bankDetail) {
                if (array_key_exists('id', $bankDetail)) {
                    TrainerBankDetail::find($bankDetail['id'])->update($bankDetail);
                } else {
                    $trainer->trainerBankDetails()->create($bankDetail);
                }
            }
        }

        //work experiences
        if (config('trainer.status.experienceForm') && config('trainer.type.experienceForm') === 'extended') {
            foreach ($data['workExperiences'] as $workExperience) {
                if (array_key_exists('id', $workExperience)) {
                    TrainerExperience::find($workExperience['id'])->update($workExperience);
                } else {
                    $trainer->trainerExperiences()->create($workExperience);
                }
            }
        }

        //qualifications
        if (config('trainer.status.qualificationForm') && config('trainer.type.qualificationForm') === 'extended') {
            foreach ($data['qualifications'] as $qualification) {
                if (array_key_exists('id', $qualification)) {
                    TrainerQualification::find($qualification['id'])->update($qualification);
                } else {
                    $trainer->trainerQualifications()->create($qualification);
                }
            }
        }

        //experience as trainees
        if (config('trainer.status.experienceAsTraineeForm') && config('trainer.type.experienceAsTraineeForm') === 'extended') {
            foreach ($data['experienceAsTrainees'] as $experienceAsTrainee) {
                if (array_key_exists('id', $experienceAsTrainee)) {
                    TrainerExperienceAsTrainee::find($experienceAsTrainee['id'])->update($experienceAsTrainee);
                } else {
                    $trainer->trainerExperienceAsTrainees()->create($experienceAsTrainee);
                }
            }
        }

        //experience as trainer

        if (config('trainer.status.experienceAsTrainerForm') && config('trainer.type.experienceAsTrainerForm') === 'extended') {
            foreach ($data['experienceAsTrainers'] as $experienceAsTrainer) {
                if (array_key_exists('id', $experienceAsTrainer)) {
                    TrainerExperienceInTraining::find($experienceAsTrainer['id'])->update($experienceAsTrainer);
                } else {
                    $trainer->trainerExperienceInTrainings()->create($experienceAsTrainer);
                }
            }
        }
        //documents
        if (config('trainer.status.otherDocumentForm')) {
            foreach ($data['documents'] as $document) {
                if (array_key_exists('id', $document)) {
                    TrainerDocument::find($document['id'])->update($document);
                } else {
                    $trainer->trainerDocuments()->create($document);
                }
            }
        }
        //subjects
        $trainer->subjects()->sync($data['subject_ids']);
    }
}
