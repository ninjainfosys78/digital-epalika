<?php

namespace Modules\Plan\Http\Requests\EquipmentAdditionalCost;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentAdditionalCostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipment_id' => ['required'],
            'fiscal_year_id' => ['required'],
            'unit_id' => ['required'],
            'rate' => ['required'],
        ];
    }
}
