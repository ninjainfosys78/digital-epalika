<?php

namespace App\Http\Requests\Setting\MeasurementUnits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_id' => ['required', Rule::exists('types', 'id')->withoutTrashed()],
            'measurement_unit_id' => ['required', Rule::exists('measurement_units', 'id')->withoutTrashed()],
            'title' => ['required'],
            'title_en' => ['required'],
            'notation' => ['required'],
            'notation_ne' => ['required'],
            'position' => ['nullable', 'integer'],
            'is_smallest' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => 'मापन एकाइ प्रकार अनिवार्य छ',
            'measurement_unit_id.required' => 'एकाइ मापन आवश्यक छ',
            'title.required' => 'शिर्षक आबश्यक छ ',
            'position.integer' => 'स्थिति अङ्क मा हुनुपर्छ ',
        ];
    }
}
