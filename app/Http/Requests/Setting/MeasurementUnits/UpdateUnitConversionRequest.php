<?php

namespace App\Http\Requests\Setting\MeasurementUnits;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitConversionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
