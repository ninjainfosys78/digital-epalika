<?php

namespace Modules\Plan\Http\Requests\FuelDemand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuelDemandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fuel_id' => ['required', 'integer', 'exists:fuels,id'],
            'equipment_id' => ['required', 'integer', 'exists:equipment,id'],
            'quantity' => ['required'],
        ];
    }
}
