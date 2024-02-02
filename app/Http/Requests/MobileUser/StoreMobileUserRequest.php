<?php

namespace App\Http\Requests\MobileUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMobileUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('mobile_users', 'email')],
            'password' => ['required', 'confirmed'],
            'tax_payer_id' => ['nullable', Rule::exists('tax_payers', 'id')->withoutTrashed()],
            'phone' => ['required', 'regex:/^(?:\+?9779\d{9}|9\d{9})$/', Rule::unique('mobile_users', 'phone')],
            'avatar' => ['nullable','image', 'mimes:png,jpg,jpeg']
        ];
    }
}
