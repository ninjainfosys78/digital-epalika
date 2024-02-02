<?php

namespace Modules\BusinessRegistration\Http\Requests\InvestmentRevenue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateInvestmentRevenueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('investmentRevenue_edit');
    }

    public function rules(): array
    {
        return [
            'object_transaction_id' => ['required', Rule::exists('object_transactions', 'id')],
            'title' => ['required'],
            'registration_amount' => ['required'],
            'renew_amount' => ['required'],
        ];
    }
}
