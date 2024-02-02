<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class DateSheetResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['date_sheets'];

        return [
            'आवेदन वर्ष' => $this->when(in_array('year', $request_columns), $this->year ?? ''),
            'केस नाम' => $this->when(in_array('case_name', $request_columns), $this->case_name ?? ''),
            'हाजिर हुने मिति' => $this->when(in_array('appearance_date', $request_columns), $this->appearance_date ?? ''),
            'हाजिर हुने समय' => $this->when(in_array('appearance_time', $request_columns), $this->appearance_time ?? ''),
            'पेश मिति' => $this->when(in_array('submitted_date', $request_columns), $this->submitted_date ?? '')
        ];
    }
}
