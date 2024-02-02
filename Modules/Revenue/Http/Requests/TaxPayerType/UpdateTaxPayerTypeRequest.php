<?php

namespace Modules\Revenue\Http\Requests\TaxPayerType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaxPayerTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255',],
            'code' => ['required', 'string', 'max:255', Rule::unique('tax_payer_types', 'code')->ignore($this->taxPayerType),],
        ];
    }
}
