<?php

namespace Modules\GrievanceHandling\Http\Requests\GrievanceUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreGrievanceUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('grievanceUser_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('grievance_users', 'email')->withoutTrashed()],
            'phone' => ['required', Rule::unique('grievance_users', 'phone')->withoutTrashed()],
            'address' => ['nullable']
        ];
    }
}
