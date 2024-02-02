<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreyDetailApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['storey_details'] ?? [];

        return [
            'map_fee_id' => $this->map_fee_id ?? '',
            'area_of_proposed_construction' => $this->area_of_proposed_construction ?? '',
            'area_of_former_construction' => $this->area_of_former_construction ?? '',
            'total_area' => $this->total_area ?? '',
            'height ' => $this->height ?? '',
            'mapApplyForm' => MapApplyFormApiResource::make($this->whenLoaded('mapApplyForm')),


        ];
    }
}
