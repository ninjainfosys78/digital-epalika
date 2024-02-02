<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name ?? '',
            'site_address' => $this->site_address ?? '',
            'logo' => $this->logo_url ?? '',
            'ward_no' => $this->localbody->wards ?? '',
        ];
    }
}
