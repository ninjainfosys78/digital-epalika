<?php

namespace Modules\Identity\Http\Requests\DisabilityCommittee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreDisabilityCommitteeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('disabilityCommittee_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable'],
            'designation' => ['nullable'],
            'position' => ['nullable', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ['नाम अनिबार्य छ']
        ];
    }
}
