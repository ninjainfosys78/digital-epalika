<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['office_settings'] ?? [];

        return [
            'name' => $this->name ?? '',
        'site_address' => $this->site_address ?? '',
        'logo' => $this->logo ?? '',
        'logo1' => $this->logo1 ?? '',
        'logo2' => $this->logo2 ?? '',
        'background_image' => $this->background_image ?? '',
        'google_map' => $this->google_map ?? '',
        'province_id' => $this->province_id ?? '',
        'district_id' => $this->district_id ?? '',
        'local_body_id' => $this->local_body_id ?? '',
        'ward_no' => $this->ward_no ?? '',
        'phone' => $this->phone ?? '',
        'email' => $this->email ?? '',
        'website' => $this->website ?? '',
        'facebook_link' => $this->facebook_link ?? '',
        'introduction' => $this->introduction ?? '',
        'fiscal_year_id' => $this->fiscal_year_id ?? '',
        ];
    }
}
