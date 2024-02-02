<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employee_name' => $this->employee_name ?? '',
            'photo' => $this->photo_url ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'designation' => $this->designation ?? '',
        ];
    }
}
