<?php

namespace App\Http\Requests\Setting\Designation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDesignationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('designations', 'title')->withoutTrashed()],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'पद अनिवार्य छ',
            'title.unique' => ' पद अद्वितीय हुनुपर्छ',
        ];
    }
}
