<?php

namespace App\Http\Requests\Setting\MeasurementUnits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeasurementUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_id' => ['required', Rule::exists('types', 'id')->withoutTrashed()],
            'title' => ['required', Rule::unique('measurement_units', 'title')->withoutTrashed()->ignore($this->measurementUnit)],
        ];
    }

    public function messages(): array
    {
        return [
            'type_id.required' => 'मापन एकाइ प्रकार अनिवार्य छ',
            'type_id.exists' => 'मापन एकाइ प्रकार छैन',
            'title.required' => 'मापन एकाइ विविधता अनिवार्य छ',
            'title.unique' => 'मापन एकाइ विविधता पहिले नै छ',
        ];
    }
}
