<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'file_name' => $this->file_name ?? '',
            'file' => $this->file_url ?? '',
            'extension' => $this->extension ?? ''
        ];
    }
}
