<?php

namespace Modules\Roaster\Http\Requests\Trainee;

use Illuminate\Foundation\Http\FormRequest;

class StoreTraineeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'citizenship_no' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'regex:/^([0-9,]*)$/'],
            'email_id' => ['nullable', 'email'],
            'ethnicity_id' => ['required', 'exists:ethnicities,id'],
            'qualification' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'current_profession' => ['nullable', 'string'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'local_body_id' => ['required', 'exists:local_bodies,id'],
            'ward_no' => ['required', 'integer'],
            'tole' => ['nullable', 'string', 'max:255'],
            'is_employee' => ['required'],
            'designation_id' => ['required_if:is_employee,==,1', 'exists:designations,id'],
            'department_id' => ['required_if:is_employee,==,1', 'exists:departments,id'],
            'service_time' => ['required_if:is_employee,==,1'],
            'office_name' => ['required_if:is_employee,==,1', 'string', 'max:255'],
            'office_address' => ['required_if:is_employee,==,1', 'string', 'max:255'],
            'office_phone' => ['required_if:is_employee,==,1'],
            'office_email' => ['required_if:is_employee,==,1', 'email'],
            'photo' => ['required', 'image', 'max:300'],
            'application_form' => ['required', 'mimes:pdf,jpg,jpeg,png'],
            'ward_recommendation' => ['required', 'mimes:pdf,jpg,jpeg,png'],
            'mark_sheet' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
            'citizenship_front' => ['required', 'mimes:pdf,jpg,jpeg,png'],
            'citizenship_back' => ['required', 'mimes:pdf,jpg,jpeg,png'],
            'passport' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
            'nomination_letter' => ['required', 'mimes:jpg,jpeg,png,pdf'],
            'recommendation_letter' => ['required', 'mimes:jpg,jpeg,png,pdf'],
            'documents' => ['nullable', 'array'],
            'documents.*.title' => ['nullable', 'string', 'max:255'],
            'documents.*.document' => ['nullable', 'file'],
        ];
    }
}
