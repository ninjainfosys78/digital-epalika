<?php

namespace Modules\Circular\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class DispatchResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['dispatches'] ?? [];

        return [
            'चलानी नं.' => $this->when(in_array('dispatch_no', $request_columns), $this->dispatch_no ?? ''),
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'चलानी मिति' => $this->when(in_array('dispatch_date', $request_columns), $this->dispatch_date ?? ''),
            'चलानी मिति ई.सं.' => $this->when(in_array('en_dispatch_date', $request_columns), $this->en_dispatch_date ?? ''),
            'पत्र संख्या' => $this->when(in_array('letter_number', $request_columns), $this->letter_number ?? ''),
            'पत्र मिति' => $this->when(in_array('letter_date', $request_columns), $this->letter_date ?? ''),
            'पत्र मिति ई.सं.' => $this->when(in_array('en_letter_date', $request_columns), $this->en_letter_date ?? ''),
            'विषय' => $this->when(in_array('subject', $request_columns), $this->subject ?? ''),
            'पाउने कार्यालयको नाम' => $this->when(in_array('receiver_name', $request_columns), $this->receiver_name ?? ''),
            'पाउने कार्यालयको ठेगाना' => $this->when(in_array('receiver_address', $request_columns), $this->receiver_address ?? ''),
            'हुलाक/ र.न./इमेल' => $this->when(in_array('receiver_contact', $request_columns), $this->receiver_contact ?? ''),
            'कैफियत' => $this->when(in_array('remarks', $request_columns), $this->remarks ?? ''),
        ];
    }
}
