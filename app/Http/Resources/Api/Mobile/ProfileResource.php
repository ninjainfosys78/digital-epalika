<?php

namespace App\Http\Resources\Api\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'created_at' => $this->created_at?->diffForHumans() ?? '',
        ];
    }
}
