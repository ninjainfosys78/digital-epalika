<?php

namespace Modules\JudicialCommittee\Http\Requests\ComplaintDecision;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;
use Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum;

class StoreComplaintDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('complaintDecision_create');
    }

    public function rules(): array
    {
        return [
            'description' => ['required'],
            'submitted_date' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf'],
            'application_status' => ['required', new Enum(ComplaintApplicationStatusEnum::class)]
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'विवरण आवश्यक छ',
            'submitted_date.required' => 'पेश मिति आवश्यक छ',
        ];
    }
}
