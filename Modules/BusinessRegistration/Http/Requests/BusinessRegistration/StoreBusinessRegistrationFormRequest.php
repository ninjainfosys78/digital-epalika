<?php

namespace Modules\BusinessRegistration\Http\Requests\BusinessRegistration;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\BusinessRegistration\Enums\Qualification;

class StoreBusinessRegistrationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'business_nature_id' => ['required', Rule::exists('business_natures', 'id')->withoutTrashed()],
            'object_transaction_id' => ['required', Rule::exists('object_transactions', 'id')->withoutTrashed()],
            'name' => ['required', 'string'],
            'name_en' => ['required', 'string',],
            'address' => ['required', 'string', 'max:255'],
            'address_en' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string'],
            'province_id' => ['nullable', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id ' => ['nullable', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['nullable', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'tole' => ['required', 'string'],
            'ward_no' => ['nullable', 'integer'],
            'way' => ['nullable', 'string'],
            'working_capital' => ['nullable'],
            'fixed_capital' => ['nullable'],
            'investment' => ['required'],
            'is_rent' => ['nullable'],
            'house_owner_name' => ['required_if:is_rent,1', 'string'],
            'house_owner_phone' => ['nullable', 'string'],
            'house_owner_address' => ['nullable', 'string'],
            'house_owner_monthly_rent' => ['nullable', 'string'],
            'length' => ['required', 'integer'],
            'width' => ['nullable'],
            'application_date' => ['required', 'date'],
            'application_date_en' => ['required', 'date'],
            'rent_agreement' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'land_ownership_certificate' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'ward_recommendation' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'embassy_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'license' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'registration_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'is_register' => ['nullable'],
            'tax_document' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'other_file' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'registration_no' => ['registration_no'],
            'partners' => ['required', 'array'],
            'partners.*.name' => ['required', 'string'],
            'partners.*.name_en' => ['required', 'string'],
            'partners.*.citizenship_no' => ['required'],
            'partners.*.issue_date' => ['required'],
            'partners.*.issue_district_id' => ['required', Rule::exists('districts', 'id')],
            'partners.*.phone' => ['required'],
            'partners.*.email' => ['nullable'],
            'partners.*.province_id' => ['nullable', Rule::exists('provinces', 'id')->withoutTrashed()],
            'partners.*.district_id' =>  ['nullable', Rule::exists('districts', 'id')->withoutTrashed()],
            'partners.*.local_body_id' => ['nullable', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'partners.*.ward_no' => ['nullable'],
            'partners.*.way' => ['nullable'],
            'partners.*.tole' => ['nullable'],
            'partners.*.house_no' => ['required'],
            'partners.*.account_no' => ['nullable'],
            'partners.*.national_card_no' => ['nullable'],
            'partners.*.gender' => ['required', new Enum(Gender::class)],
            'partners.*.education_qualification' => ['required', new Enum(Qualification::class)],
            'partners.*.father_name' => ['required', 'string'],
            'partners.*.grandfather_name' => ['required'],
            'partners.*.photo' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'partners.*.signature' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'partners.*.citizenship_front' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'partners.*.citizenship_back' => ['nullable', 'mimes:png,jpg,jpeg,pdf'],
            'partners.*.position' => ['required', 'integer'],
            'registeredBusinesses' => ['required_if:is_register,1', 'array'],
            'registeredBusinesses.*.business_name' => ['required_if:is_register,1'],
            'registeredBusinesses.*.registration_no' => ['nullable',],
            'registeredBusinesses.*.registration_date' => ['nullable', 'date'],
            'registeredBusinesses.*.is_active' => ['nullable', 'boolean'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file']

        ];
    }
}
