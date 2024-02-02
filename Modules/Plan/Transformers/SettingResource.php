<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['map_settings'] ?? [];

        return [
            'thumbnail' => $this->thumbnail ?? '',
            'document' => $this->document ?? '',
            'map_request_form_format' => $this->map_request_form_format ?? '',
            'land_measurement_id' => $this->land_measurement_id ?? '',
            'land_measurement_standard_id' => $this->land_measurement_standard_id ?? '',
            'standard_land_measurement' => $this->standardLandMeasurement->title ?? ''
        ];

    }
}
