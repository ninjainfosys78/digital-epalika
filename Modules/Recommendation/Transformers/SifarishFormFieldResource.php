<?php

namespace Modules\Recommendation\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SifarishFormFieldResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'sifarish_form_type_id' => $this->sifarish_form_type_id ?? '',
            'field_name' => $this->field_name ?? '',
            'slug' => $this->slug ?? ''
        ];
    }
}
