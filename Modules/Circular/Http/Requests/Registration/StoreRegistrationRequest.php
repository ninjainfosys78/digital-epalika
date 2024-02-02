<?php

namespace Modules\Circular\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('registration_create');
    }

    public function rules(): array
    {
        return [

            'branch_id' => ['required', Rule::exists('branches', 'id')->withoutTrashed()],
            'registration_date' => ['required'],
            'en_registration_date' => ['nullable', 'date'],
            'letter_number' => ['nullable'],
            'letter_date' => ['required'],
            'en_letter_date' => ['nullable', 'date'],
            'sender_name' => ['required'],
            'subject' => ['required'],
            'receiver_name' => ['required'],
            'phone' => ['nullable'],
            'email' => ['nullable', 'email', Rule::unique('registrations', 'email')->withoutTrashed()],
            'signature_image' => ['nullable', 'image'],
            'date' => ['nullable'],
            'remarks' => ['nullable'],
            'documents' => ['required', 'array'],
            'documents.*' => ['mimes:jpg,png,jpeg,pdf'],
        ];
    }

    public function messages()
    {
        return [
            'registration_no.required' => 'दर्ता नं अनिबार्य छ।',
            'registration_no.unique' => 'दर्ता नं पहिले नै लिइएको छ।',
            'registration_date.required' => 'दर्ता मिति अनिबार्य छ।',
            'letter_date.required' => 'पत्र मिति अनिबार्य छ।',
            'sender_name.required' => 'पठाउने कार्यालयको नाम अनिबार्य छ।',
            'subject.required' => 'बिषय अनिबार्य छ।',
            'receiver_name.required' => 'बुझिलिनेको नाम अनिबार्य छ।',
            'circularDocuments.required' => 'कागजात अनिबार्य छ।',
            'signature_image.image' => 'हस्ताक्षर फोटो फर्ममा छ।',
            'documents.mimes' => 'फाइल अनिबार्य jpg, png, jpeg, pdf मा हुनुपर्छ।',
        ];
    }
}
