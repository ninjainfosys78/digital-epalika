<?php

namespace Modules\BusinessRegistration\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentRevenueResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'registration_amount' => $this->registration_amount ?? '',
            'renew_amount' => $this->renew_amount ?? ''
        ];
    }
}
