<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SipharishFormTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'content' => $this->content ?? '',
            'need_approval' => $this->need_approval ?? '',
            'status' => $this->status == 1 ? true : false,
            'created_by' => $this->createdBy?->name ?? ''
        ];
    }
}
