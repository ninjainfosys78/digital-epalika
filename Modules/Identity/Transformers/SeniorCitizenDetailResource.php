<?php

namespace Modules\Identity\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SeniorCitizenDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $seniorCitizenDetail = $request->input('columns')['senior_citizen_details'] ?? [];
        return [
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $seniorCitizenDetail), $this->fiscalYear->title ?? ''),
            'नाम' => $this->when(in_array('name', $seniorCitizenDetail), $this->name ?? ''),
            'नाम अग्रेजीमा' => $this->when(in_array('name_en', $seniorCitizenDetail), $this->name_en ?? ''),
            'ठेगाना' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole'], $seniorCitizenDetail), function () use ($seniorCitizenDetail) {
                return $this->resolveAddress($seniorCitizenDetail);
            }),
            'जन्म मिति (वि.स.)' => $this->when(in_array('dob_bs', $seniorCitizenDetail), $this->dob_bs ?? ''),
            'जन्म मिति (ई.स.)' => $this->when(in_array('dob_ad', $seniorCitizenDetail), $this->dob_ad ?? ''),
            'कार्ड नं.' => $this->when(in_array('card_no', $seniorCitizenDetail), $this->card_no ?? ''),
            'लिङ्ग' => $this->when(in_array('gender', $seniorCitizenDetail), $this->gender?->label() ?? ''),
            'नागरिता नं' => $this->when(in_array('citizenship_no', $seniorCitizenDetail), $this->citizenship_no ?? ''),
            'जारी मिति (वि.स.)' => $this->when(in_array('issue_date_bs', $seniorCitizenDetail), $this->issue_date_bs ?? ''),
            'पति/पत्नीको नाम' => $this->when(in_array('spouse', $seniorCitizenDetail), $this->spouse ?? ''),
            'पति/पत्नीको नाम अग्रेजीमा' => $this->when(in_array('spouse_en', $seniorCitizenDetail), $this->spouse_en ?? ''),
            'रक्त समूह' => $this->when(in_array('blood_group', $seniorCitizenDetail), $this->blood_group?->label() ?? ''),
            'बुवाको नाम' => $this->when(in_array('father_name', $seniorCitizenDetail), $this->father_name ?? ''),
            'बुवाको नाम अग्रेजीमा' => $this->when(in_array('father_name_en', $seniorCitizenDetail), $this->father_name_en ?? ''),
            'आमाको नाम अग्रेजीमा' => $this->when(in_array('mother_name_en', $seniorCitizenDetail), $this->mother_name_en ?? ''),
            'आमाको नाम' => $this->when(in_array('mother_name', $seniorCitizenDetail), $this->mother_name ?? ''),
            'संरक्षकको नाम' => $this->when(in_array('patrons_name', $seniorCitizenDetail), $this->patrons_name ?? ''),
            'संरक्षकको नाम अग्रेजीमा' => $this->when(in_array('patrons_name_en', $seniorCitizenDetail), $this->patrons_name_en ?? ''),
            'संरक्षकको ठेगाना' => $this->when(in_array('patrons_name_address', $seniorCitizenDetail), $this->patrons_name_address ?? ''),
            'सम्पर्क व्यक्ति नाम' => $this->when(in_array('contact_person_name', $seniorCitizenDetail), $this->contact_person_name ?? ''),
            'सम्पर्क व्यक्ति नाम अग्रेजीमा' => $this->when(in_array('contact_person_name_en', $seniorCitizenDetail), $this->contact_person_name_en ?? ''),
            'सम्पर्क व्यक्तिको सम्पर्क नं' => $this->when(in_array('contact_person_phone', $seniorCitizenDetail), $this->contact_person_phone ?? ''),
            'सम्पर्क व्यक्तिको ठेगाना' => $this->when(in_array('contact_person_address', $seniorCitizenDetail), $this->contact_person_address ?? ''),
            'रोगको नाम' => $this->when(in_array('disease_name', $seniorCitizenDetail), $this->disease_name ?? ''),
            'हेरचाह केन्द्रको विवरण' => $this->when(in_array('description', $seniorCitizenDetail), $this->description ?? ''),
            'हेरचाह केन्द्रको विवरण अग्रेजीमा' => $this->when(in_array('description_en', $seniorCitizenDetail), $this->description_en ?? ''),
            'औषधिको नाम' => $this->when(in_array('medicine_name', $seniorCitizenDetail), $this->medicine_name ?? ''),

        ];
    }

    private function resolveAddress($seniorCitizenDetail): string
    {
        $address = '';
        if (in_array('local_body_id', $seniorCitizenDetail)) {
            $address .= $this->localBody->local_body ?? '';
        }
        if (in_array('ward_no', $seniorCitizenDetail)) {
            $address .= '-' . ($this->ward_no ?? '');
        }
        if (in_array('tole', $seniorCitizenDetail)) {
            $address .= ', ' . ($this->tole ?? '');
        }
        if (in_array('district_id', $seniorCitizenDetail)) {
            $address .= ', ' . ($this->district->district ?? '');
        }
        if (in_array('province_id', $seniorCitizenDetail)) {
            $address .= ', ' . ($this->province->province ?? '');
        }
        return $address;
    }
}
