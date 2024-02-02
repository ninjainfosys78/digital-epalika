<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title ?? '',
            'image' => $this->image_url ?? '',
            'description' => $this->description ?? '',
        ];
    }
}
