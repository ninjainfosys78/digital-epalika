<?php

namespace Modules\GrievanceHandling\Http\Requests\GrievanceUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateGrievanceUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grievanceUser_edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('grievance_users', 'email')->withoutTrashed()->ignore($this->grievanceUser)],
            'phone' => ['required', Rule::unique('grievance_users', 'phone')->withoutTrashed()->ignore($this->grievanceUser)],
            'address' => ['nullable']
        ];
    }
}
