<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeHeaderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'font' => $this->font ?? '',
            'font_size' => $this->font_size ?? '',
            'font_color' => $this->font_color ?? '',
        ];
    }
}
