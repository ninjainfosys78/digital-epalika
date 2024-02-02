<?php

namespace Modules\JudicialCommittee\Transformers\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintApplicationResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['complaint_applications'] ?? [];

        return [
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'सबमिशन नं.' => $this->when(in_array('submission_no', $request_columns), $this->submission_no ?? ''),
            'दर्ता नम्बर' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'मुद्दा प्रकृति' => $this->when(in_array('lawsuit_nature_id', $request_columns), $this->lawsuitNature->title ?? ''),
            'निवेदकको नाम' => $this->when(in_array('applicant_name', $request_columns), $this->applicant_name ?? ''),
            'निवेदकको फोन' => $this->when(in_array('applicant_phone', $request_columns), $this->applicant_phone ?? ''),
            'निवेदकको ठेगाना' => $this->when(in_array('applicant_address', $request_columns), $this->applicant_address ?? ''),
            'वादीको विवरण' => $this->whenLoaded('complainantDefendants', function () {
                return ComplainantDefendantResource::collection($this->complainantDefendants->where('type', 'complainant'));
            }),
            'प्रतिवादीको विवरण' => $this->whenLoaded('complainantDefendants', function () {
                return ComplainantDefendantResource::collection($this->complainantDefendants->where('type', 'defendant'));
            }),
            'विषय' => $this->when(in_array('subject', $request_columns), $this->subject ?? ''),
            'विवरण' => $this->when(in_array('complaint_detail', $request_columns), $this->complaint_detail ?? ''),
            'मिति बि.सं.' => $this->when(in_array('date', $request_columns), $this->date ?? ''),
            'मिति इ.सं.' => $this->when(in_array('en_date', $request_columns), $this->en_date ?? ''),
            'निवेदकको हस्ताक्षर' => $this->when(in_array('applicant_signature', $request_columns), $this->applicant_signature ?? ''),
            'साक्षीहरु' => WitnessResource::collection($this->whenLoaded('witnesses')),
            'सम्बन्धित सदस्यहरू' => RelatedMemberResource::collection($this->whenLoaded('relatedMembers')),
            'तारिख पर्चा विवरण' => DateSheetResource::collection($this->whenLoaded('dateSheets')),
            'प्रतिवादी म्याद जारी' => DefendantIssuedDeadlineResource::collection($this->whenLoaded('defendantIssuedDeadlines')),
        ];
    }
}
