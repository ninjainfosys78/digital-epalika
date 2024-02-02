<?php

namespace Modules\BusinessRegistration\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray($request)
    {
        $request_columns = $request->input('columns')['partners'] ?? [];
        return [
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'व्यवसायी ठेगाना ' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole','way'], $request_columns), function () use ($request_columns) {
                return $this->resolveAddress($request_columns);
            }),
            'नाम अंग्रेजीमा' => $this->when(in_array('name_en', $request_columns), $this->name_en ?? ''),
            'नागरिकता नम्बर' => $this->when(in_array('citizenship_no', $request_columns), $this->citizenship_no ?? ''),
            'जारि मिति' => $this->when(in_array('issue_date', $request_columns), $this->issue_date ?? ''),
            'नागरिकता जारी जिल्ला' => $this->when(in_array('issue_district_id', $request_columns), $this->issueDistrict->district ?? ''),
            'फोन' => $this->when(in_array('phone', $request_columns), $this->phone ?? ''),
            'इमेल' => $this->when(in_array('email', $request_columns), $this->email ?? ''),
            'घर नम्बर' => $this->when(in_array('house_no', $request_columns), $this->house_no ?? ''),
            'व्यक्तिगत स्थाई लेखा नम्बर' => $this->when(in_array('account_no', $request_columns), $this->account_no ?? ''),
            'राष्ट्रियता परिचयपत्र नम्बर' => $this->when(in_array('national_card_no', $request_columns), $this->national_card_no ?? ''),
            'लिङ्ग' => $this->when(in_array('gender', $request_columns), $this->gender?->label() ?? ''),
            'शैक्षिक योग्यता' => $this->when(in_array('education_qualification', $request_columns), $this->education_qualification?->label() ?? ''),
            'मुख्य पेशा' => $this->when(in_array('occupation', $request_columns), $this->occupation ?? ''),
            'बुबाको नाम' => $this->when(in_array('father_name', $request_columns), $this->father_name ?? ''),
            'हजुरबुबाको नाम' => $this->when(in_array('grandfather_name', $request_columns), $this->grandfather_name ?? ''),
            'पासपोर्ट साइजको फोटो' => $this->when(in_array('photo', $request_columns), $this->photo ?? ''),
            'हस्ताक्षर' => $this->when(in_array('signature', $request_columns), $this->signature ?? ''),
            'नागरिकता अपलोड गर्नुहोस् (आगाडी)' => $this->when(in_array('citizenship_front', $request_columns), $this->citizenship_front ?? ''),
            'नागरिकता अपलोड गर्नुहोस् (पछाडी)' => $this->when(in_array('citizenship_back', $request_columns), $this->citizenship_back ?? ''),
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
        if (in_array('way', $request_columns)) {
            $address .= ', ' . ($this->way ?? '');
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
