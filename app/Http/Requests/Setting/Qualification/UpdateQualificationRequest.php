<?php

namespace App\Http\Requests\Setting\Qualification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQualificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'achievement' => ['required'],
            'major_subject' => ['required'],
            'institute' => ['required'],
            'passed_year' => ['required','size:4'],
            'remarks' => ['nullable'],
        ];
    }
}
