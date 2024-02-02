<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyNumberResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title ?? '',
            'contact_no' => $this->contact_no ?? '',
            'latitude' => $this->latitude ?? '',
            'longitude' => $this->longitude ?? '',
            'contact_person_name' => $this->contact_person_name ?? '',
            'address' => $this->address ?? '',
            'GoogleMapsUrl' => $this->GoogleMapsUrl ?? ''
        ];
    }
}
