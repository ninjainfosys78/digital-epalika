<?php

namespace App\Http\Resources\Api\v1\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'province_id' => $this->province_id ?? '',
            'district' => $this->district ?? '',
            'district_en' => $this->district_en ?? '',
            'localBodies' => LocalBodyResource::collection($this->whenLoaded('localBodies')),
        ];
    }
}
