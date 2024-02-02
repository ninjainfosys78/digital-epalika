<?php

namespace Modules\Plan\Http\Requests\CrewRate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCrewRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'labour_id' => ['required', 'integer', 'exists:labours,id'],
            'equipment_id' => ['required', 'integer', 'exists:equipment,id'],
            'quantity' => ['required'],
        ];
    }
}
