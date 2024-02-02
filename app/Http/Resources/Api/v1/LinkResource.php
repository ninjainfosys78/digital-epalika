<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'link_title' => $this->link_title ?? '',
            'link_url' => $this->link_url ?? '',
        ];
    }
}
