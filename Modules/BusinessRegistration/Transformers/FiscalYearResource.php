<?php

namespace Modules\BusinessRegistration\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FiscalYearResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? ''
        ];
    }
}
