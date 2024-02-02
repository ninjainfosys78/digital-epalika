<?php

namespace Modules\DigitalBoard\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_name' => ['required', 'string', 'max:255', Rule::unique('branches', 'branch_name')->withoutTrashed()],
            'branch_id' => ['nullable', Rule::exists('branches', 'id')]
        ];
    }

    public function messages()
    {
        return [
            'branch_name.required' => 'शाखाको  नाम आवश्यक छ',
            'branch_name.unique' => 'शाखाको नाम अद्वितीय हुनुपर्छ'
        ];
    }
}
