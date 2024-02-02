<?php

namespace Modules\Roaster\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TraineeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'trainee_open_date' => $this->trainee_open_date ?? '',
            'trainee_closed_date' => $this->trainee_closed_date ?? '',
        ];
    }
}
