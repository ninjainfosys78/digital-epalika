<?php

namespace Modules\EMap\Http\Requests\TaxClearance;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaxClearanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['required'],
            'document' => ['required', 'mimes:png,jpg,jpeg'],
        ];
    }
}
