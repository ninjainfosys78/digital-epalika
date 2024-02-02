<?php

namespace Modules\BusinessRegistration\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['business_details'] ?? [];
        return [
            'सबमिशन नम्बर' => $this->when(in_array('submission_no', $request_columns), $this->submission_no ?? ''),
            'व्यवसाय ठेगाना ' => $this->when((bool)array_intersect(['province_id', 'district_id', 'local_body_id', 'ward_no', 'tole','way'], $request_columns), function () use ($request_columns) {
                return $this->resolveAddress($request_columns);
            }),
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'व्यवसायको प्रकृति ' => $this->when(in_array('business_nature_id', $request_columns), $this->businessNature->title ?? ''),
            'बिल नं.' => $this->when(in_array('bill_no', $request_columns), $this->bill_no ?? ''),
            'बिल मिति बि स.' => $this->when(in_array('bill_date_bs', $request_columns), $this->bill_date_bs ?? ''),
            'बिल मिति ई स.' => $this->when(in_array('bill_date_ad', $request_columns), $this->bill_date_ad ?? ''),
            'रकम' => $this->when(in_array('amount', $request_columns), $this->amount ?? ''),
            'करदाता नम्बर' => $this->when(in_array('taxpayer_number', $request_columns), $this->taxpayer_number ?? ''),
            'दर्ता नम्बर' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'दर्ता मिति बि. सं.' => $this->when(in_array('registration_date_ne', $request_columns), $this->registration_date_ne ?? ''),
            'दर्ता मिति ई. सं.' => $this->when(in_array('registration_date_en', $request_columns), $this->registration_date_en ?? ''),
            'व्यवसायको नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'व्यवसायको नाम(अंग्रेजीमा)' => $this->when(in_array('name_en', $request_columns), $this->name_en ?? ''),
            'ठेगाना' => $this->when(in_array('address', $request_columns), $this->address ?? ''),
            'ठेगाना(अंग्रेजीमा)' => $this->when(in_array('address_en', $request_columns), $this->address_en ?? ''),
            'उद्देश्य' => $this->when(in_array('purpose', $request_columns), $this->purpose ?? ''),
            'व्यवसायको कारोबार गर्ने मुख्य सेवा वा बस्तु' => $this->when(in_array('object_transaction_id', $request_columns), $this->objectTransaction->title ?? ''),
            'चालु पूँजी' => $this->when(in_array('working_capital', $request_columns), $this->working_capital ?? ''),
            'स्थिर पूँजी' => $this->when(in_array('fixed_capital', $request_columns), $this->fixed_capital ?? ''),
            'पूँजीगत लगानी' => $this->when(in_array('investment', $request_columns), $this->investment ?? ''),
            'घर मालिकको नाम' => $this->when(in_array('house_owner_name', $request_columns), $this->house_owner_name ?? ''),
            'घर मालिकको फोन' => $this->when(in_array('house_owner_phone', $request_columns), $this->house_owner_phone ?? ''),
            'घर मालिकको ठेगाना' => $this->when(in_array('house_owner_address', $request_columns), $this->house_owner_address ?? ''),
            'घर मालिक मासिक भाडा' => $this->when(in_array('house_owner_monthly_rent', $request_columns), $this->house_owner_monthly_rent ?? ''),
            'लम्बाई' => $this->when(in_array('length', $request_columns), $this->length ?? ''),
            'चौडाई' => $this->when(in_array('width', $request_columns), $this->width ?? ''),
            'आवेदन मिति बि. सं.' => $this->when(in_array('application_date', $request_columns), $this->application_date ?? ''),
            'आवेदन मिति ई. सं.' => $this->when(in_array('application_date_en', $request_columns), $this->application_date_en ?? ''),
            'भाडा सम्झौता' => $this->when(in_array('rent_agreement', $request_columns), $this->rent_agreement ?? ''),
            'आफ्नै घर जग्गा भए जग्गा धनि प्रमाणपत्र' => $this->when(in_array('land_ownership_certificate', $request_columns), $this->land_ownership_certificate ?? ''),
            'वार्ड सिफारिस' => $this->when(in_array('ward_recommendation', $request_columns), $this->ward_recommendation ?? ''),
            'राजदूतावासको कागजात' => $this->when(in_array('embassy_document', $request_columns), $this->embassy_document ?? ''),
            'दर्ता प्रमाणपत्र' => $this->when(in_array('registration_document', $request_columns), $this->registration_document ?? ''),
            'इजाजत पत्र' => $this->when(in_array('license', $request_columns), $this->license ?? ''),
            'कर तिरेको प्रमाणपत्र' => $this->when(in_array('tax_document', $request_columns), $this->tax_document ?? ''),
            'व्यवसायी विवरण' => PartnerResource::collection($this->whenLoaded('partners')),
            'अघि दर्ता भएका व्यवसाय' => RegisterBusinessResource::collection($this->whenLoaded('registeredBusinesses')),
            'व्यवसाय नवीकरण' => BusinessRenewResource::collection($this->whenLoaded('businessRenew')),
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
