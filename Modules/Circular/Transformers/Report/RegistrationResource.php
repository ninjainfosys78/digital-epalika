<?php

namespace Modules\Circular\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['registrations'] ?? [];

        return [
            'दर्ता नं.' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'दर्ता मिति (वि.स.)' => $this->when(in_array('registration_date', $request_columns), $this->registration_date ?? ''),
            'दर्ता मिति (ई.सं.)' => $this->when(in_array('en_registration_date', $request_columns), $this->en_registration_date ?? ''),
            'पत्र संख्या' => $this->when(in_array('letter_number', $request_columns), $this->letter_number ?? ''),
            'पत्र मिति' => $this->when(in_array('letter_date', $request_columns), $this->letter_date ?? ''),
            'पत्र मिति (ई.सं.)' => $this->when(in_array('en_letter_date', $request_columns), $this->en_letter_date ?? ''),
            'पठाउने कार्यालयको नाम' => $this->when(in_array('sender_name', $request_columns), $this->sender_name ?? ''),
            'विषय' => $this->when(in_array('subject', $request_columns), $this->subject ?? ''),
            'बुझिलिनेको नाम' => $this->when(in_array('receiver_name', $request_columns), $this->receiver_name ?? ''),
            'बुझिलिनेको फोन' => $this->when(in_array('phone', $request_columns), $this->phone ?? ''),
            'मिति' => $this->when(in_array('date', $request_columns), $this->date ?? ''),
            'कैफियत' => $this->when(in_array('remarks', $request_columns), $this->remarks ?? ''),
        ];
    }
}
