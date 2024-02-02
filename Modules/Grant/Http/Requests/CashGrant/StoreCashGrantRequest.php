<?php

namespace Modules\Grant\Http\Requests\CashGrant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCashGrantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'address' => ['required'],
            'age' => ['required'],
            'contact' => ['required'],
            'citizenship_no' => ['required'],
            'father_name' => ['required'],
            'grandfather_name' => ['required'],
            'helplessness_type_id' => ['required', Rule::exists('helplessness_types', 'id')->withoutTrashed()],
            'cash' => ['required'],
            'file' => ['nullable'],
            'remark' => ['nullable']
        ];
    }
}
