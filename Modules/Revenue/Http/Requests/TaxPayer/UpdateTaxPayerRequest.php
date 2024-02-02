<?php

namespace Modules\Revenue\Http\Requests\TaxPayer;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateTaxPayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tax_payer_type_id' => ['required', Rule::exists('tax_payer_types', 'id')->withoutTrashed()],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'gender' => ['required', 'string', 'max:255', new Enum(Gender::class)],
            'father_name' => ['required', 'string', 'max:255'],
            'grandfather_name' => ['required', 'string', 'max:255'],
            'citizenship_no' => ['required', 'string', 'max:255', Rule::unique('tax_payers', 'citizenship_no')->withoutTrashed()->ignore($this->taxPayer->id)],
            'issued_district' => ['required', 'string', 'max:255'],
            'issued_date' => ['required'],
            'ward' => ['required', 'string', 'max:255'],
            'tole' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
