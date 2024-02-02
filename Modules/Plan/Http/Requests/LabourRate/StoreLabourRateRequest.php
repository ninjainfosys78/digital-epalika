<?php

namespace Modules\Plan\Http\Requests\LabourRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabourRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fiscal_year_id' => ['required'],
            'labour_id' => ['required'],
            'rate' => ['required'],
        ];
    }
}
