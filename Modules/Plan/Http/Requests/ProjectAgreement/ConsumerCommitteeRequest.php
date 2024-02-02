<?php

namespace Modules\Plan\Http\Requests\ProjectAgreement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Enums\ConsumerCommitteePostEnum;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;

class ConsumerCommitteeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'address' => ['nullable'],
            'phone' => ['nullable'],
            'formation_date' => ['required'],
            'committee_registration_date' => ['required'],
            'meeting_date' => ['nullable'],
            'registration_no' => ['required'],
            'beneficiary_no' => ['required', 'integer'],
            'experience_in_project' => ['nullable'],
            'consumerCommitteeOfficials' => ['nullable', 'array'],
            'consumerCommitteeOfficials.*.post' => ['required', new Enum(ConsumerCommitteePostEnum::class)],
            'consumerCommitteeOfficials.*.name' => ['required'],
            'consumerCommitteeOfficials.*.father_name' => ['nullable'],
            'consumerCommitteeOfficials.*.grandfather_name' => ['nullable'],
            'consumerCommitteeOfficials.*.address' => ['nullable'],
            'consumerCommitteeOfficials.*.gender' => ['nullable'],
            'consumerCommitteeOfficials.*.phone' => ['nullable'],
            'consumerCommitteeOfficials.*.citizenship_no' => ['nullable'],
            'operated_through' => ['required', new Enum(ProjectOperatedThroughEnum::class)],
            'contract_date' => ['required'],
            'project_start_date' => ['required'],
            'project_completion_date' => ['required', 'after:form.project_start_date'],
        ];
    }
}
