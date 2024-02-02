<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
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
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'audio' => $this->audio_url ?? '',
        ];
    }
}
