<?php

namespace Modules\EMap\Http\Requests\MapRegistration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMapRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'particulars' => ['nullable', 'array'],
            'particulars.*.id' => ['required', 'string'],
            'particulars.*.storey' => ['required', 'string'],
            'particulars.*.area' => ['required', 'numeric', 'min:0'],
            'particulars.*.rate' => ['required', 'numeric', 'min:0'],
            'particulars.*.remarks' => ['nullable', 'string'],
            'form_receipt' => ['required', 'numeric', 'min:0'],
            'application_registration_fee' => ['required', 'numeric', 'min:0'],
            'other' => ['required', 'numeric', 'min:0'],
            'nepali_date' => ['required', 'date'],
            'english_date' => ['required', 'date'],
            'receipt_no' => ['required'],
            'recipient' => ['required'],
        ];
    }
}
