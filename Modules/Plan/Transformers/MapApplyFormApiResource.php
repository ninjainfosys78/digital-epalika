<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MapApplyFormApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['map_applies'] ?? [];


        return [

            'construction_type' => $this->construction_type ?? '',
            'usage' => $this->usage ?? '',
            'structure_type_id' => $this->structure_type_id ?? '',
            'current_storey' => $this->current_storey ?? '',
            'future_storey' => $this->future_storey ?? '',
            'area_of_plinth' => $this->area_of_plinth ?? '',
            'length' => $this->length ?? '',
            'breadth' => $this->breadth ?? '',
            'height' => $this->height ?? '',
            'organization_id' => $this->organization_id ?? '',
            'application_type' => $this->application_type ?? '',
            'latitude' => $this->latitude ?? '',
            'longitude' => $this->longitude ?? '',
            'building_category' => $this->building_category ?? '',

        ];
    }
}
