<?php

namespace Modules\JudicialCommittee\Http\Requests\JudicialMember;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateJudicialMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('judicialMember_edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'designation' => ['required', 'string', 'max:255'],
            'address' => ['nullable'],
            'position' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'नाम आवश्यक छ',
            'designation.required' => 'पद आवश्यक छ',
            'position.integer' => 'मर्यादा क्रम संख्यामा हुनुपर्छ'
        ];
    }
}
