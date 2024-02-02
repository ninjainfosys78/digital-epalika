<?php

namespace Modules\Circular\Http\Requests\Dispatch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateDispatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('dispatch_edit');
    }

    public function rules(): array
    {
        return [
            'dispatch_no' => ['required', Rule::unique('dispatches', 'dispatch_no')->withoutTrashed()->ignore($this->dispatch)],
            'dispatch_date' => ['required'],
            'en_dispatch_date' => ['nullable', 'date'],
            'letter_number' => ['required'],
            'letter_date' => ['required'],
            'en_letter_date' => ['nullable', 'date'],
            'subject' => ['required', 'max:255'],
            'receiver_name' => ['required', 'max:255'],
            'receiver_address' => ['required', 'max:255'],
            'receiver_contact' => ['required','email' ,Rule::unique('dispatches', 'receiver_contact')->withoutTrashed()->ignore($this->dispatch)],
            'remarks' => ['nullable'],

        ];
    }

    public function messages()
    {
        return [
            'dispatch_no.required' => 'चलानी न. अनिबार्य छ',
            'dispatch_no.unique' => 'चलानी न. पहिले नै लिइएको छ।',
            'dispatch_date.required' => 'चलानी मिति अनिबार्य छ ',
            'letter_number.required' => 'पत्र संख्या अनिबार्य छ ',
            'letter_date.required' => 'पत्रको मिति अनिबार्य छ',
            'subject.required' => 'बिषय अनिबार्य छ ',
            'receiver_name.required' => 'पाउने कार्यालयको नाम अनिबार्य छ ',
            'receiver_address.required' => 'पाउने कार्यालयको ठेगाना अनिबार्य छ ',
            'receiver_contact.required' => 'पाउने सम्पर्क अनिबार्य छ ',
            'receiver_signature.image' => 'हस्तक्षर् फोटो फाइलमा छ ',
            'date.required' => 'मिति अनिबार्य छ ',
            'documents.required' => 'डकुमेन्ट अनिबार्य छन् ',
            'documents.mimes' => 'डकुमेन्ट अनिबार्य jpg, png, jpeg, pfd मा छन् ',
        ];
    }
}
