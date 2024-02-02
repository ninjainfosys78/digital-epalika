<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CitizenCharterResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'branch_name' => $this->branch?->branch_name,
            'service' => $this->service ?? '',
            'required_document' => $this->required_document ?? '',
            'amount' => $this->amount ?? '',
            'time' => $this->time ?? '',
            'responsible_person' => $this->responsible_person ?? '',
        ];
    }
}
