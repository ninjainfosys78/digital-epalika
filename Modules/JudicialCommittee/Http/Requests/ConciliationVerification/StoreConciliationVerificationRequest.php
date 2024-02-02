<?php

namespace Modules\JudicialCommittee\Http\Requests\ConciliationVerification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreConciliationVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('conciliationVerification_create');
    }

    public function rules(): array
    {
        return [
            'description' => ['required'],
            'submitted_date' => ['required'],
            'files' => ['nullable', 'array'],
            'files.*' => ['mimes:jpg,png,jpeg,pdf']
        ];
    }
}
