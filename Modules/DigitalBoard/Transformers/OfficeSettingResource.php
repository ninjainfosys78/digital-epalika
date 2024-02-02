<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'logo' => $this->logo_url ?? '',
            'logo1' => $this->logo1_url ?? '',
            'logo2' => $this->logo2_url ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'address' => $this->site_address ?? '',
            'background_image' => $this->background_image_url ?? '',
        ];
    }
}
