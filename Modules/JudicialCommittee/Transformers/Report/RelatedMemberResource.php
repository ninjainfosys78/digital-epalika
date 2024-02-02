<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class RelatedMemberResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['related_members'];

        return [
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'फोन' => $this->when(in_array('phone', $request_columns), $this->phone ?? ''),
            'इमेल' => $this->when(in_array('email', $request_columns), $this->email ?? ''),
            'पद' => $this->when(in_array('designation', $request_columns), $this->designation ?? ''),
            'ठेगाना' => $this->when(in_array('address', $request_columns), $this->address ?? ''),
        ];
    }
}
