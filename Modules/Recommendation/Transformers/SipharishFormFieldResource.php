<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SipharishFormFieldResource extends JsonResource
{
    public function toArray($request)
    {
        return [

            'field_name' => $this->field_name ?? '',
            'slug' => $this->slug ?? '',

            'type' => $this->type ?? '',
            'sipharish_form_field_id' => $this->id ?? '',
            'sipharishFormFields' => SipharishFormFieldResource::collection($this->whenLoaded('SipharishFormFields')) ?? null
        ];
    }
}
