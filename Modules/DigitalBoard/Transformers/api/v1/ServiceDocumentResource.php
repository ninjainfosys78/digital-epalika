<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'description' => $this->description ?? '',
        ];
    }
}
