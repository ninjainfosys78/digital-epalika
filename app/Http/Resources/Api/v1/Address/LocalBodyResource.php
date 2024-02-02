<?php

namespace App\Http\Resources\Api\v1\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalBodyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'district_id' => $this->district_id ?? '',
            'local_body' => $this->local_body ?? '',
            'local_body_en' => $this->local_body_en ?? '',
            'districts' => DistrictResource::make($this->whenLoaded('district')),
            $this->mergeWhen(!$request->routeIs('api.v1.admin.address.district.show'), [
                'wardNumbers' => $this->ward_no ?? [],
            ]),
            'toles' => ToleResource::collection($this->whenLoaded('toles')),
        ];
    }
}
