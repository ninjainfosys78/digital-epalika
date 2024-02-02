<?php

namespace Modules\JudicialCommittee\Http\Requests\Conciliation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreConciliationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('conciliation_create');
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
