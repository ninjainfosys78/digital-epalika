<?php

namespace App\Http\Resources\Api\v1\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class ToleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'localBody' => LocalBodyResource::make($this->whenLoaded('localBody')),
            'local_body_id' => $this->local_body_id ?? '',
            'id' => $this->id ?? '',
            'ward_no' => $this->ward_no ?? '',
            'title' => $this->title ?? '',
            'title_en' => $this->title_en ?? '',
        ];
    }
}
