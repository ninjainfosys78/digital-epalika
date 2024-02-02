<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class LandDetailApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['land_details'] ?? [];

        return [
            'map_apply_id' => $this->map_apply_id ?? '',
            'land_use_area' => $this->land_use_area ?? '',
            'ward_no' => $this->ward_no ?? '',
            'former_ward_no' => $this->former_ward_no ?? '',
            'tole ' => $this->tole ?? '',
            'street_code_no  ' => $this->street_code_no  ?? '',
            'plot_no   ' => $this->plot_no   ?? '',
            'percentage_of_area_covered_by_building   ' => $this->percentage_of_area_covered_by_building   ?? '',
            'unit_value   ' => $this->unit_value   ?? '',
            'mapApplyForm' => MapApplyFormApiResource::make($this->whenLoaded('mapApplyForm')),

        ];
    }
}
