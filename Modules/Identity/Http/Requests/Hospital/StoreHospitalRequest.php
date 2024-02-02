<?php

namespace Modules\Identity\Http\Requests\Hospital;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreHospitalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('hospital_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable'],
            'email' => ['nullable', 'email'],
            'address' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ['नाम अनिबार्य छ'],
            'address.required' => ['ठेगाना अनिबार्य छ'],
        ];
    }
}
