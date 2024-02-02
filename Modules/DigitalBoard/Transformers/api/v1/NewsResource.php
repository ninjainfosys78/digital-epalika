<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

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
            'type' => 'समाचार',
                'description' => $this->description ?? '',
                'files' => FileResource::collection($this->whenLoaded('files')),
        ];
    }
}
