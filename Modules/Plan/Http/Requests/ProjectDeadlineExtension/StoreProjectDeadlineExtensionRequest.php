<?php

namespace Modules\Plan\Http\Requests\ProjectDeadlineExtension;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectDeadlineExtensionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'extended_date' => ['required','after:submitted_date'],
            'en_extended_date' => ['required', 'date','after:en_submitted_date'],
            'submitted_date' => ['required'],
            'en_submitted_date' => ['required', 'date'],
            'remarks' => ['nullable']
        ];
    }
}
