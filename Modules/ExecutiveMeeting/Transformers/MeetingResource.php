<?php

namespace Modules\ExecutiveMeeting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'committee_id' => $this->committee_id ?? '',
            'title' => $this->meeting_name ?? '',
            'start' => $this->en_start_date ?? '',
            'ne_start_date' => $this->start_date ?? '',
            'end' => $this->en_end_date ?? '',
            'en_end_date' => $this->en_end_date,
            'ne_end_date' => $this->end_date ?? '',
            'description' => $this->description ?? ''
        ];
    }
}
