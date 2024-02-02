<?php

namespace App\Http\Requests\Setting\EmergencyCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmergencyCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'image' => ['nullable','image','mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'शिर्षक आबस्यक छ',
        ];
    }
}
