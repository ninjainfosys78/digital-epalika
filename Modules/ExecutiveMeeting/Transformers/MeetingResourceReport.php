<?php

namespace Modules\ExecutiveMeeting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResourceReport extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['meetings'] ?? [];
        return [
            'आर्थिक वर्ष' => $this->when(in_array('fiscalYear', $request_columns), $this->fiscalYear->title ?? ''),
            'बैठक नाम' => $this->when(in_array('meeting_name', $request_columns), $this->meeting_name ?? ''),
            'समिति' => $this->when(in_array('committee_id', $request_columns), $this->committee->committee_name ?? ''),
            'सुरू मिति (वि. स.)' => $this->when(in_array('start_date', $request_columns), $this->start_date ?? ''),
            'सुरू मिति (ई. स.)' => $this->when(in_array('en_start_date', $request_columns), $this->en_start_date ?? ''),
            'अन्तिम मिति (वि. स.)' => $this->when(in_array('end_date', $request_columns), $this->end_date ?? ''),
            'अन्तिम मिति (ई. स.)' => $this->when(in_array('en_end_date', $request_columns), $this->en_end_date ?? ''),
            'पुनरावृत्ति मिति (वि.स.)' => $this->when(in_array('recurrence_end_date', $request_columns), $this->recurrence_end_date ?? ''),
            'पुनरावृत्ति मिति (ई. स.)' => $this->when(in_array('en_recurrence_end_date', $request_columns), $this->en_recurrence_end_date ?? ''),
            'विवरण' => $this->when(in_array('description', $request_columns), $this->description ?? ''),
        ];
    }
}
