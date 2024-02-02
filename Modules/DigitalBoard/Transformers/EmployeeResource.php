<?php

namespace Modules\DigitalBoard\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'department' => $this->department ?? '',
            'designation' => $this->designation ?? '',
            'photo' => $this->photo_url ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
        ];
    }
}
