<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class houseOwnerApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['house_owners'] ?? [];

        return [
            'map_apply_id' => $this->map_apply_id ?? '',
            'name ' => $this->name ?? '',
            'phone ' => $this->phone ?? '',
            'father_name ' => $this->father_name ?? '',
            'grandfather_name ' => $this->grandfather_name ?? '',
            'citizenship_issue_district_id ' => $this->citizenship_issue_district_id ?? '',
            'citizenship_no  ' => $this->citizenship_no  ?? '',
            'citizenship_issue_date  ' => $this->citizenship_issue_date  ?? '',
            'address  ' => $this->address  ?? '',
            'local_body   ' => $this->local_body   ?? '',
            'ward_no   ' => $this->ward_no   ?? '',
            'mapApplyForm' => MapApplyFormApiResource::make($this->whenLoaded('mapApplyForm')),


        ];
    }
}
