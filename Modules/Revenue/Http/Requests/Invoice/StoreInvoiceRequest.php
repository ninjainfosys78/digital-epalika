<?php

namespace Modules\Revenue\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "payment_date" => ['required'],
            "payment_date_en" => ['required'],
            "tax_payer_id" => ['required', 'exists:tax_payers,id,deleted_at,NULL'],
            "fiscal_year_id" => ['required', 'exists:fiscal_years,id,deleted_at,NULL'],
            "payment_method" => ['required', 'in:Cash,Bank'],
            "reference_code" => ['required_if:payment_method,Bank'],
            "ward" => ['nullable', 'string'],
            "particulars" => ['required', 'array'],
            "particulars.*.revenue" => ['required', 'string'],
            "particulars.*.quantity" => ['required', 'integer', 'min:0'],
            "particulars.*.rate" => ['required', 'integer', 'min:0'],
            "particulars.*.due" => ['nullable', 'integer', 'min:0'],
            "particulars.*.fine" => ['nullable', 'integer', 'min:0'],
            "particulars.*.remarks" => ['nullable'],
            "remarks" => ['nullable']
        ];
    }
}
