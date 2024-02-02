<?php

namespace App\Http\Requests\MobileUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'email', Rule::unique('mobile_users', 'email')->withoutTrashed()->ignore(auth()->user())],
            'phone' => ['required', Rule::unique('mobile_users', 'phone')->withoutTrashed()->ignore(auth()->user())],
        ];
    }
}
