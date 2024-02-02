<?php

namespace Modules\DigitalBoard\Transformers;

use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'date' => $this->date ?? '',
            'description' => $this->description ?? '',
            'files' => FileResource::collection($this->whenLoaded('files')),
        ];
    }
}
