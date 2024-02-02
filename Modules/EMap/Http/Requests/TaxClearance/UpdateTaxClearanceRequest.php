<?php

namespace Modules\EMap\Http\Requests\TaxClearance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaxClearanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['required'],
            'document' => ['mimes:png,jpg,jpeg'],
        ];
    }
}
