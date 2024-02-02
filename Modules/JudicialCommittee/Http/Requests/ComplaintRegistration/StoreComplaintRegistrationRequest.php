<?php

namespace Modules\JudicialCommittee\Http\Requests\ComplaintRegistration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComplaintRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'applicant_name' => ['required'],
            'applicant_phone' => ['required'],
            'subject' => ['required'],
            'complaint_detail' => ['required'],
            'date' => ['required'],
            'en_date' => ['nullable'],
            'applicant_address' => ['nullable'],
            'applicant_signature' => ['nullable'],
            'application_status' => ['nullable'],
            'complaint_subject_id' => ['required', Rule::exists('complaint_subjects', 'id')->withoutTrashed()],
            'complainantDefendents' => ['required', 'array'],
            'complainantDefendents.*.complain_type' => ['required', 'string', 'max:255'],
            'complainantDefendents.*.name' => ['required', 'string', 'max:255'],
            'complainantDefendents.*.age' => ['nullable', 'integer'],
            'complainantDefendents.*.father_name' => ['nullable', 'string', 'max:255'],
            'complainantDefendents.*.grandfather_name' => ['nullable', 'string', 'max:255'],
            'complainantDefendents.*.spouse_name' => ['nullable', 'string', 'max:255'],
            'complainantDefendents.*.province_id' => ['nullable', 'exists:provinces,id'],
            'complainantDefendents.*.district_id' => ['nullable', 'exists:districts,id'],
            'complainantDefendents.*.local_body_id' => ['nullable', 'exists:local_bodies,id'],
            'complainantDefendents.*.ward_no' => ['required', 'integer'],
            'complainantDefendents.*.tole' => ['nullable'],

            'relatedMembers' => ['nullable', 'array'],
            'relatedMembers.*.name' => ['nullable'],
            'relatedMembers.*.phone' => ['nullable'],
            'relatedMembers.*.email' => ['nullable', 'email'],
            'relatedMembers.*.designation' => ['nullable'],
            'relatedMembers.*.address' => ['nullable'],
            'witnesses' => ['nullable', 'array'],
            'witnesses.*.name' => ['required', 'string', 'max:255'],
            'witnesses.*.age' => ['nullable', 'integer'],
            'witnesses.*.phone' => ['nullable'],
            'witnesses.*.address' => ['nullable'],
            'supportedDocuments' => ['nullable','array'],
            'supportedDocuments.*.document_name' => ['nullable', 'string', 'max:255'],
            'supportedDocuments.*.document' => ['nullable', 'mimes:jpg,jpeg,png,pdf']
        ];
    }
}
