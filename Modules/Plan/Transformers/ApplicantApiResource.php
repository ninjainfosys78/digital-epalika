<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'map_apply_id' => $this->map_apply_id ?? '',
            'applicant_type ' => $this->applicant_type ?? '',
            'relation_with_owner ' => $this->relation_with_owner ?? '',
            'name ' => $this->name ?? '',
            'phone ' => $this->phone ?? '',
            'father_name ' => $this->father_name ?? '',
            'citizenship_issue_district_id ' => $this->citizenship_issue_district_id ?? '',
            'citizenship_no  ' => $this->citizenship_no  ?? '',
            'citizenship_issue_date  ' => $this->citizenship_issue_date  ?? '',
            'address  ' => $this->address  ?? '',
            'application_date  ' => $this->application_date  ?? '',
            'signature  ' => $this->signature  ?? '',
            'mapApplyForm' => MapApplyFormApiResource::make($this->whenLoaded('mapApplyForm')),


        ];
    }
}
