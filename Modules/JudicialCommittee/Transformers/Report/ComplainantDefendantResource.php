<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplainantDefendantResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['complainant_defendants'] ?? [];

        return [
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'उमेर' => $this->when(in_array('age', $request_columns), $this->age ?? ''),
            'बुवाको नाम' => $this->when(in_array('father_name', $request_columns), $this->father_name ?? ''),
            'हजुरबुबाको नाम' => $this->when(in_array('grandfather_name', $request_columns), $this->grandfather_name ?? ''),
            'पति/पत्नीको नाम' => $this->when(in_array('spouse_name', $request_columns), $this->spouse_name ?? ''),
            'ठेगाना' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole'], $request_columns), function () use ($request_columns) {
                return $this->resolveAddress($request_columns);
            }),
        ];
    }

    private function resolveAddress($request_columns): string
    {
        $address = '';
        if (in_array('local_body_id', $request_columns)) {
            $address .= $this->localBody->local_body ?? '';
        }
        if (in_array('ward_no', $request_columns)) {
            $address .= '-' . ($this->ward_no ?? '');
        }
        if (in_array('tole', $request_columns)) {
            $address .= ', ' . ($this->tole ?? '');
        }
        if (in_array('district_id', $request_columns)) {
            $address .= ', ' . ($this->district->district ?? '');
        }
        if (in_array('province_id', $request_columns)) {
            $address .= ', ' . ($this->province->province ?? '');
        }
        return $address;
    }
}
