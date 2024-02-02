<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class DefendantIssuedDeadlineResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['defendant_issued_deadlines'];

        return [
            'सहभागी हुनुपर्ने दिन' => $this->when(in_array('day_to_attend', $request_columns), $this->day_to_attend ?? ''),
            'पेश मिति' => $this->when(in_array('submitted_date', $request_columns), $this->submitted_date ?? ''),
        ];
    }
}
