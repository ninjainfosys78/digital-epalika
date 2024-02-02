<?php

namespace Modules\BusinessRegistration\Http\Requests\ObjectTransaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreObjectTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('objectTransaction_create');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'object_transaction_id' => ['nullable', Rule::exists('object_transactions', 'id')],
        ];
    }
}
