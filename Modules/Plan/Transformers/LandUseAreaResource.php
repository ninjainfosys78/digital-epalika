<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class LandUseAreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'coordinates' => $this->coordinates ?? '',
        ];
    }
}
