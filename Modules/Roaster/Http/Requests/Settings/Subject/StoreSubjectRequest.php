<?php

namespace Modules\Roaster\Http\Requests\Settings\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'level' => ['required'],
            'duration' => ['required'],
            'content' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'विषय अनिवार्य छ',
            'level.required' => 'स्तर अनिवार्य छ',
            'duration.required' => 'अवधि अनिवार्य छ',
        ];
    }
}
