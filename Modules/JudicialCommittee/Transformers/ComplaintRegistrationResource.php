<?php

namespace Modules\JudicialCommittee\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintRegistrationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',

            'fiscal_year_id' => $this->fiscal_year_id ?? '',
            'submission_no' => $this->submission_no ?? '',
            'registration_no' => $this->registration_no ?? '',
            'lawsuit_nature_id' => $this->lawsuit_nature_id ?? '',
            'complaint_subject_id' => $this->complaint_subject_id ?? '',
            'subject' => $this->subject ?? '',
            'complaint_detail' => $this->complaint_detail ?? '',
            'date' => $this->date ?? '',
            'en_date' => $this->en_date ?? '',
            'applicant_name' => $this->applicant_name ?? '',
            'applicant_phone' => $this->applicant_phone ?? '',
            'applicant_address' => $this-> applicant_address ?? '',
            'applicant_signature' => $this->applicant_signature ?? '',
            'application_status' => $this->application_status ?? ''
        ];
    }
}
