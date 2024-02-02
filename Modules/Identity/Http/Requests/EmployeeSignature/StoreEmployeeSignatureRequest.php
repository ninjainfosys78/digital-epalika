<?php

namespace Modules\Identity\Http\Requests\EmployeeSignature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEmployeeSignatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('employeeSignature_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'designation_en' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'pin' => ['required'],
            'black_signature' => ['required', 'image'],
            'red_signature' => ['required', 'image'],
            'stamp' => ['required', 'image'],
            'status' => ['nullable','boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ['नाम आवश्यक छ'],
            'name_en.required' => ['नाम अंग्रेजीमा आवश्यक छ'],
            'designation_en.required' => ['पद अंग्रेजीमा आवश्यक छ'],
            'designation.required' => ['पद आवश्यक छ'],
            'pin.required' => ['पिन आवश्यक छ'],
            'black_signature.required' => ['कालो हस्ताक्षर आवश्यक छ'],
            'red_signature.required' => ['रातो हस्ताक्षर आवश्यक छ'],
            'stamp.required' => ['छाप आवश्यक छ'],
        ];
    }
}
