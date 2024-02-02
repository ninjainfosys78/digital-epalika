<?php

namespace Modules\JudicialCommittee\Http\Requests\ConciliationApplication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreConciliationApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('conciliationApplication_create');
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
