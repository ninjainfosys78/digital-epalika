<?php

namespace App\Http\Requests\Setting\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_name' => ['required', Rule::unique('branches', 'branch_name')->withoutTrashed()->ignore($this->branch)],
            'branch_id' => ['nullable', Rule::exists('branches', 'id')],
        ];
    }

    public function messages()
    {
        return [
            'branch_name.required' => 'शाखाको  नाम आवश्यक छ',
            'branch_name.unique' => 'शाखाको नाम अद्वितीय हुनुपर्छ',
        ];
    }
}
