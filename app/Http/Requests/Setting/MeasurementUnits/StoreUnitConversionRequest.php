<?php

namespace App\Http\Requests\Setting\MeasurementUnits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitConversionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversion' => ['required', 'array'],
            'conversion.*.conversion_to' => ['required', Rule::exists('units', 'id')->withoutTrashed()],
            'conversion.*.rate' => ['required', 'numeric'],
        ];
    }
}
