<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'district' => $this->district ?? '',
            'district_en' => $this->district_en ?? '',
        ];
    }
}
