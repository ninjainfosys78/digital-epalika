<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessRenew;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreBusinessRenewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('businessRenew_create');
    }

    public function rules(): array
    {
        return [
            'business_renew_date' => ['required'],
            'business_renew_date_en' => ['nullable'],
            'date_to_be_maintained' => ['required'],
            'date_to_be_maintained_en' => ['nullable'],
            'renew_amount' => ['required'],
            'penalty_amount' => ['required'],
            'payment_receipt' => ['required'],
            'payment_receipt_date' => ['required'],
            'payment_receipt_date_en' => ['nullable'],
        ];
    }
}
