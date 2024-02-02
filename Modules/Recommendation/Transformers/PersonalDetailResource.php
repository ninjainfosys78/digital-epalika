<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'user_id' => $this->user_id ?? '',
            'reg_no' => $this->reg_no ?? '',
            'name' => $this->name ?? '',
            'phone_no' => $this->phone_no ?? '',
            'is_minor' => $this->is_minor ?? '',
            'gender' => $this->gender ?? '',
            'citizenship_no' => $this->citizenship_no ?? '',
            'province_id' => $this->province_id ?? '',
            'district_id' => $this->district_id ?? '',
            'local_body_id' => $this->local_body_id ?? '',
            'ward_no' => $this->ward_no ?? '',
            'tole' => $this->tole ?? '',

        ];
    }
}
