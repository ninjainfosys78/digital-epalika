<?php

namespace Modules\ExecutiveMeeting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeEventResource extends JsonResource
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
            'className' => $this->className ?? '',
            'start' => $this->start?->toDateString() ?? '',
            'end' => $this->end?->toDateString() ?? '',
        ];
    }
}
