<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'video' => $this->video_url ?? '',
        ];
    }
}
