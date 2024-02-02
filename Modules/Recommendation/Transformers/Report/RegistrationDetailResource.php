<?php

namespace Modules\Recommendation\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['registration_details'] ?? [];
        return [

            'आर्थिक वर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'दर्ता नं' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'सिफारिस प्रकार' => $this->when(in_array('recommendation_category_id', $request_columns), $this->recommendationCategory->title ?? ''),
            'व्यक्तिगत विवरण' => $this->when(in_array('personal_detail_id', $request_columns), $this->personalDetail->name ?? ''),
            'मिति वि.स.' => $this->when(in_array('date_ne', $request_columns), $this->date_ne ?? ''),
            'मिति ई.स' => $this->when(in_array('date_en', $request_columns), $this->date_en ?? ''),
            'वडा नं' => $this->when(in_array('ward_no', $request_columns), $this->ward_no ?? ''),
//            'व्यवसाय ठेगाना ' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole','way'], $request_columns), function () use ($request_columns) {
//                return $this->resolveAddress($request_columns);
//            }),
        ];
    }
}
