<?php

namespace Modules\BusinessRegistration\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterBusinessResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['registered_businesses'] ?? [];
        return [
            'दर्ता नम्बर' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'नाम' => $this->when(in_array('business_name', $request_columns), $this->business_name ?? ''),
            'दर्ता मिति' => $this->when(in_array('registration_date', $request_columns), $this->registration_date ?? ''),
        ];
    }
}
