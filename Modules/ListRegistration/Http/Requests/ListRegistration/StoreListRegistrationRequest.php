<?php

namespace Modules\ListRegistration\Http\Requests\ListRegistration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\ListRegistration\Enums\ApplicantCategoryEnum;
use Modules\ListRegistration\Enums\BusinessNatureEnum;

class StoreListRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('listRegistration_create');
    }

    public function rules(): array
    {
        return [
            'registration_no' => ['required', Rule::unique('list_registrations', 'registration_no')],
            'applicant_type' => ['required', new Enum(ApplicantCategoryEnum::class)],
            'name' => ['nullable'],
            'address' => ['required'],
            'mailing_address' => ['required'],
            'main_person' => ['required'],
            'telephone' => ['nullable'],
            'mobile_no' => ['required'],
            'application_photo' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'registration_certificate' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'pan_photo' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'tax_payment_certificate' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'license_photo' => ['nullable', 'mimes:jpg,jpeg,png,pdf'],
            'business_nature' => ['required',new Enum(BusinessNatureEnum::class)],
            'business_nature_description' => ['required'],
            'date' => ['required'],
            'en_date' => ['required','date'],
            'files' => ['nullable', 'array'],
            'files.*.file_name' => ['required'],
            'files.*.file' => ['required', 'mimes:jpg,jpeg,png,pdf'],
        ];
    }

    public function messages()
    {
        return [
            'registration_no.required' => 'दर्ता नम्बर आवश्यक छ',
            'registration_no.unique' => 'दर्ता नम्बर अद्वितीय छ',
            'applicant_type.required' => 'दर्ता प्रकार आवश्यक छ',
            'address.required' => 'ठेगाना आवश्यक छ',
            'mailing_address.required' => 'मेलिङ ठेगाना आवश्यक छ',
            'mobile_no.required' => 'मोबाइल न. अनिबार्य छ ',
            'main_person.required' => 'मुख्य व्यक्तिको नाम आवश्यक छ',
            'application_photo.mimes' => 'फोटो अनिबार्य jpeg, png, jpeg, pdf मा हुनुपर्छ ',
            'registration_certificate.mimes' => 'प्रमाण पत्र अनिबार्य jpg, jpeg, png, pdf मा हुनुपर्छ ',
            'pan_photo' => 'पाना फोटो अनिबार्य jpeg, jpg, png, pdf मा हुनुपर्छ ',
            'tax_payment_certificate.mimes' => 'कर तिरेको प्रमाण पत्र अनिबार्य jpg, jpeg, png, pdf मा हुनुपर्छ ',
            'license_photo.mimes' => 'लाइसेन्सको फोटो अनिबार्य jpeg, jpg, png, pdf मा हुनुपर्छ ',
            'date.required' => 'मिति अनिबार्य छ',
            'business_nature.required' => 'खरिद प्रकृति अनिबार्य छ',
            'business_nature_description.required' => 'बिबरण अनिबार्य छ',
        ];
    }
}
