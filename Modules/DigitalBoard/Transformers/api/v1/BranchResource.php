<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'branch_name' => $this->branch_name ?? '',
            'branches' => BranchResource::collection($this->whenLoaded('branches')),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),
            'branch_services' => ServiceResource::collection($this->whenLoaded('branchServices')),

        ];
    }
}
