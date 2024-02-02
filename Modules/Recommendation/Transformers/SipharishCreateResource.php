<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SipharishCreateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'status' => $this->status == 1 ? true : false,
            'created_by' => $this->createdBy?->name ?? '',
        ];
    }
}
