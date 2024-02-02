<?php

namespace Modules\DigitalBoard\Transformers\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name ?? '',
            'department' => $this->department ?? '',
            'designation' => $this->designation ?? '',
            'photo' => $this->photo_url ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
        ];
    }
}
