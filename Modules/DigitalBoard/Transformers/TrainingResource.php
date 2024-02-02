<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name' => $this->name ?? '',
            'open_date' => $this->open_date ?? '',
            'closed_date' => $this->closed_date ?? '',
            'form_type' => $this->form_type ?? '',
        ];
    }
}
