<?php

namespace Modules\Grant\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerReportResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['farmers'] ?? [];
        return [
            'कृषक आइडी' => $this->when(in_array('unique_id', $request_columns), $this->unique_id ?? ''),
            'अगाडीको नाम' => $this->when(in_array('first_name', $request_columns), $this->first_name ?? ''),
            'बिचको नाम' => $this->when(in_array('middle_name', $request_columns), $this->middle_name ?? ''),
            'थर' => $this->when(in_array('last_name', $request_columns), $this->last_name ?? ''),
            'फोटो' => $this->when(in_array('photo', $request_columns), $this->photo ?? ''),
            'लिङ्ग' => $this->when(in_array('gender', $request_columns), $this->gender->label() ?? ''),
            'वैवाहिक स्थिति' => $this->when(in_array('marital_status', $request_columns), $this->marital_status->label() ?? ''),
            'दम्पतिको नाम' => $this->when(in_array('spouse_name', $request_columns), $this->spouse_name ?? ''),
            'बुबाको नाम' => $this->when(in_array('father_name', $request_columns), $this->father_name ?? ''),
            'हजुरबुबाको नाम' => $this->when(in_array('grandfather_name', $request_columns), $this->grandfather_name ?? ''),
            'नागरिकता नं' => $this->when(in_array('citizenship_no', $request_columns), $this->citizenship_no ?? ''),
            'किसान परिचयपत्र नं' => $this->when(in_array('farmer_id_card_no', $request_columns), $this->farmer_id_card_no ?? ''),
            'राष्ट्रिय परिचयपत्र नं' => $this->when(in_array('national_id_card_no', $request_columns), $this->national_id_card_no ?? ''),
            'फोन नं' => $this->when(in_array('phone_no', $request_columns), $this->phone_no ?? ''),
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
