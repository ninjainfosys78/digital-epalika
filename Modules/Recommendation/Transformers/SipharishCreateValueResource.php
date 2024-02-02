<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SipharishCreateValueResource extends JsonResource
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
            'field_name' => $this->SipharisFormField?->field_name ?? '',
            'value' => $this->value ?? ''
        ];
    }
}
