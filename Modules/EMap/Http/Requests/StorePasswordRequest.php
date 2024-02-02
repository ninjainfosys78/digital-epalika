<?php

namespace Modules\EMap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (config('app.env') === 'production') {
            return [
                'password' => [
                    'string', 'min:8', 'confirmed',
                ],
                'g-recaptcha-response' => ['recaptcha'],
            ];
        }

        return [
            'password' => [
                'string', 'min:8', 'confirmed',
            ],
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.recaptcha' => 'Please verify captcha',
        ];
    }
}
