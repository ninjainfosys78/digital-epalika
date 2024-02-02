<?php

namespace App\Http\Requests\MobileUser;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckCurrentPasswordRule;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', new CheckCurrentPasswordRule()],
            'password' => ['required|string|min:7'],
        ];
    }
}
