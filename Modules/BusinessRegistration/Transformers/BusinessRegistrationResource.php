<?php

namespace Modules\BusinessRegistration\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessRegistrationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'submission_no' => $this->submission_no ?? '',
            'fiscal_year_id' => $this->fiscal_year_id ?? '',
            'name' => $this->name ?? '',
            'name_en' => $this->name_en ?? '',
            'address' => $this->address ?? '',
            'address_en' => $this->address_en ?? '',
            'purpose' => $this->purpose ?? '',
            'province_id' => $this->province_id ?? '',
            'district_id' => $this->district_id ?? '',
            'local_body_id' => $this->local_body_id ?? '',
            'ward_no' => $this->ward_no ?? '',
            'way' => $this->way ?? '',
            'tole' => $this->tole ?? '',
            'business_nature_id' => $this->business_nature_id ?? '',
            'object_transaction_id' => $this->object_transaction_id ?? '',
            'working_capital' => $this->working_capital ?? '',
            'fixed_capital' => $this->fixed_capital ?? '',
            'investment' => $this->investment ?? '',
            'is_rent' => $this->is_rent ?? '',
            'is_register' => $this->is_rent ?? '',
            'house_owner_name' => $this->house_owner_name ?? '',
            'house_owner_phone' => $this->house_owner_phone ?? '',
            'house_owner_address' => $this->house_owner_address ?? '',
            'house_owner_monthly_rent' => $this->house_owner_monthly_rent ?? '',
            'length' => $this->length ?? '',
            'width' => $this->width ?? '',
            'application_date' => $this->application_date ?? '',
            'application_date_en' => $this->application_date_en ?? '',
            'rent_agreement' => $this->rent_agreement ?? '',
            'land_ownership_certificate' => $this->land_ownership_certificate ?? '',
            'ward_recommendation' => $this->ward_recommendation ?? '',
            'embassy_document' => $this->embassy_document ?? '',
            'registration_document' => $this->registration_document ?? '',
            'license' => $this->license ?? '',

        ];
    }
}
