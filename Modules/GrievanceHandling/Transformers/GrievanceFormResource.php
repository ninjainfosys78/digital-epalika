<?php

namespace Modules\GrievanceHandling\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class GrievanceFormResource extends JsonResource
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
            'grievance_detail_id' => $this->grievance_detail_id ?? '',
            'token' => $this->token ?? '',
            'grievance_user_id' => $this->grievance_user_id ?? '',
            'user_id' => $this->user_id ?? '',
            'grievance_type_id' => $this->grievance_type_id ?? '',
            'branch_id' => $this->branch_id ?? '',
            'publisher_id' => $this->publisher_id ?? '',
            'assigned_user_id' => $this->assigned_user_id ?? '',
            'assigned_at' => $this->assigned_at ?? '',
            'subject' => $this->subject ?? '',
            'description' => $this->description ?? '',
            'complaint_severity' => $this->complaint_severity ?? '',
            'is_open' => $this->is_open ?? '',
            'status' => $this->status ?? '',
            'is_approved' => $this->is_approved ?? '',
            'is_public' => $this->is_public ?? '',
            'grievance_medium' => $this->grievance_medium ?? '',
            'is_anonymous' => $this->is_anonymous ?? '',

        ];
    }
}
