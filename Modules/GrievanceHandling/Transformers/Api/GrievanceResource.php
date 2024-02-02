<?php

namespace Modules\GrievanceHandling\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class GrievanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'token' => $this->token ?? '',
            'grievance_type_id' => $this->grievance_type_id ?? '',
            'grievance_type' => $this->grievanceType?->title ?? '',
            'branch_id' => $this->branch_id ?? '',
            'branch' => $this->branch?->branch_name ?? '',
            'publisher_id' => $this->publisher_id ?? '',
            'subject' => $this->subject ?? '',
            'description' => $this->description ?? '',
            'complaint_severity' => $this->complaint_severity?->label() ?? '',
            'is_open' => $this->is_open ?? '',
            'status' => $this->status?->label() ?? '',
            'is_approved' => $this->is_approved ?? '',
            'is_public' => $this->is_public ?? '',
            'grievance_medium' => $this->grievance_medium?->label() ?? '',
            'is_anonymous' => $this->is_anonymous ?? '',
            'created_at' => $this->created_at?->diffForHumans() ?? '',
        ];
    }
}
