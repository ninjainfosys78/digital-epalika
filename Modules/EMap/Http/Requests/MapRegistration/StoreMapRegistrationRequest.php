<?php

namespace Modules\EMap\Http\Requests\MapRegistration;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nepali_date' => ['required', 'date'],
            'english_date' => ['required', 'date'],
            'receipt_no' => ['required'],
            'recipient' => ['required'],
            'amount' => ['required','numeric'],
            'remarks' => ['nullable'],
            'tax_payer' => ['nullable']
        ];
    }
}
