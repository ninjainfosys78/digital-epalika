<?php

namespace App\Http\Requests\MobileUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class StoreRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Replace this with your actual authorization logic.
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:mobile_users,email',
            'phone' => 'required',
            'password' => ['required', 'confirmed', 'min:7'],
        ];
    }

    // protected function prepareForValidation()
    // {
    //     // Hash the password before validation
    //     $this->merge([
    //         'password' => Hash::make($this->input('password')),
    //     ]);
    // }
}
