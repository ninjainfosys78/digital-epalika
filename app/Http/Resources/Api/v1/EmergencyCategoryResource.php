<?php

namespace App\Http\Resources\Api\v1;

use App\Http\Resources\EmergencyNumberResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyCategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'icon' => $this->image ?? '',
            'emergencyNumbers' => EmergencyNumberResource::collection($this->whenLoaded('emergencyNumbers'))
        ];
    }
}
