<?php

namespace Modules\ListRegistration\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ListRegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['list_registrations'] ?? [];

        return [
            'दर्ता नं.' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'आवेदक प्रकार' => $this->when(in_array('applicant_type', $request_columns), $this->applicant_type?->label() ?? ''),
            'नाम' => $this->when(in_array('name', $request_columns), $this->name ?? ''),
            'ठेगाना' => $this->when(in_array('address', $request_columns), $this->address ?? ''),
            'पत्राचार ठेगाना' => $this->when(in_array('mailing_address', $request_columns), $this->mailing_address ?? ''),
            'मुख्य व्यक्ति' => $this->when(in_array('main_person', $request_columns), $this->main_person ?? ''),
            'टेलिफोन' => $this->when(in_array('telephone', $request_columns), $this->telephone ?? ''),
            'फोन नम्बर' => $this->when(in_array('mobile_no', $request_columns), $this->mobile_no ?? ''),
            'आवेदन फोटो' => $this->when(in_array('application_photo', $request_columns), $this->application_photo ?? ''),
            'दर्ता प्रमाणपत्र' => $this->when(in_array('registration_certificate', $request_columns), $this->registration_certificate ?? ''),
            'प्यान फोटो' => $this->when(in_array('pan_photo', $request_columns), $this->pan_photo ?? ''),
            'कर भुक्तानी प्रमाणपत्र' => $this->when(in_array('tax_payment_certificate', $request_columns), $this->tax_payment_certificate ?? ''),
            'लाइसेन्स फोटो' => $this->when(in_array('license_photo', $request_columns), $this->license_photo ?? ''),
            'व्यापार प्रकृति' => $this->when(in_array('business_nature', $request_columns), $this->business_nature?->label() ?? ''),
            'व्यापार प्रकृति विवरण' => $this->when(in_array('business_nature_description', $request_columns), $this->business_nature_description ?? ''),
            'मिति' => $this->when(in_array('date', $request_columns), $this->date ?? ''),
        ];
    }
}
