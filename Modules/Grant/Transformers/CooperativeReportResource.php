<?php

namespace Modules\Grant\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CooperativeReportResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['cooperatives'] ?? [];
        return [
            'सहकारीको आइडी' => $this->when(in_array('unique_id', $request_columns), $this->unique_id ?? ''),
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'सहकारीको प्रकार' => $this->when(in_array('cooperative_type_id', $request_columns), $this->cooperativeType->title ?? ''),
            'दर्ता नम्बर' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'दर्ता मिति' => $this->when(in_array('registration_date', $request_columns), $this->registration_date ?? ''),
            'भ्याट प्यान' => $this->when(in_array('vat_pan', $request_columns), $this->vat_pan ?? ''),
            'सम्बद्धता' => $this->when(in_array('affiliation_id', $request_columns), $this->affiliation->name ?? ''),
            'ठेगाना ' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole','village'], $request_columns), function () use ($request_columns) {
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
        if (in_array('village', $request_columns)) {
            $address .= ', ' . ($this->village ?? '');
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
