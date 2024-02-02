<?php

namespace App\Http\Requests\Setting\EmergencyNumber;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmergencyNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'contact_no' => ['required'],
            'emergency_category_id' => ['required', Rule::exists('emergency_categories', 'id')->withoutTrashed()],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'contact_person_name' => ['required'],
            'address' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'प्रकार आबश्यक छ',
            'title.required' => 'शिर्षक आबस्यक छ',
            'contact_no.required' => 'सम्पर्क नं. आबश्यक छ',
            'emergency_category_id.required' => 'सम्पर्क नं. आबश्यक छ'
        ];
    }
}
