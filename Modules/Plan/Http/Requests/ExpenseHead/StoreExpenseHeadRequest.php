<?php

namespace Modules\Plan\Http\Requests\ExpenseHead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseHeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('expense_heads', 'title')->withoutTrashed()]
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'शीर्षक आवश्यक छ'
        ];
    }
}
