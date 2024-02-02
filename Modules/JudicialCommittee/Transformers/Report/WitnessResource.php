<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class WitnessResource extends JsonResource
{
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['witnesses'] ?? [];

        return [
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'उमेर' => $this->when(in_array('age', $request_columns), $this->age ?? ''),
            'फोन' => $this->when(in_array('phone', $request_columns), $this->phone ?? ''),
            'ठेगाना' => $this->when(in_array('address', $request_columns), $this->address ?? ''),
        ];
    }
}
