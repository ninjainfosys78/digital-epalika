<?php

namespace Modules\EMap\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MapApplyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'unique_id' => $this->unique_id ?? '',
            'applied_on' => $this->created_at?->diffForHumans() ?? ''
        ];
    }
}
