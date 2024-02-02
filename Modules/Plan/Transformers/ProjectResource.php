<?php

namespace Modules\Plan\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request): array
    {
        $request_columns = $request->input('columns')['projects'] ?? [];

        return [
            'दर्ता नं.' => $this->when(in_array('registration_no', $request_columns), $this->registration_no ?? ''),
            'आर्थिक बर्ष' => $this->when(in_array('fiscal_year_id', $request_columns), $this->fiscalYear->title ?? ''),
            'आयोजनाको नाम' => $this->when(in_array('project_name', $request_columns), $this->project_name ?? ''),
            'योजना क्षेत्र' => $this->when(in_array('plan_area_id', $request_columns), $this->planArea->area_name ?? ''),
            'आयोजनाको अवस्था' => $this->when(in_array('project_status', $request_columns), $this->project_status?->label()),
            'आयोजना हुने सुरु मिति' => $this->when(in_array('project_start_date', $request_columns), $this->project_start_date ?? ''),
            'आयोजना सम्पन्‍न हुने मिति' => $this->when(in_array('project_completion_date', $request_columns), $this->project_completion_date ?? ''),
            'योजना स्तर' => $this->when(in_array('plan_level_id', $request_columns), $this->planLevel->level_name ?? ''),
            'वार्ड नं.' => $this->when(in_array('ward_no', $request_columns), $this->ward_no ?? ''),
            'बजेट शीर्षक' => $this->when(in_array('budget_head_id', $request_columns), $this->budgetHead->title ?? ''),
            'विनियोजित रकम' => $this->when(in_array('allocated_amount', $request_columns), $this->allocated_amount ?? 0),
            'कार्यक्रम स्थल' => $this->when(in_array('project_venue', $request_columns), $this->project_venue ?? ''),
            'मूल्याङ्कन रकम' => $this->when(in_array('evaluation_amount', $request_columns), $this->evaluation_amount ?? 0),
            'उद्देश्य' => $this->when(in_array('purpose', $request_columns), $this->purpose ?? ''),
            'मार्फत सञ्चालन' => $this->when(in_array('operated_through', $request_columns), $this->operated_through?->label()),
            'भौतिक प्रगति लक्ष्य परिमाण' => $this->when(in_array('progress_spent_amount', $request_columns), $this->progress_spent_amount ?? 0),
            'भौतिक प्रगति सम्पन्न परिमाण' => $this->when(in_array('physical_progress_completed', $request_columns), $this->physical_progress_completed ?? 0),
            'भौतिक प्रगति एकाइ' => $this->when(in_array('physical_progress_unit', $request_columns), $this->physical_progress_unit ?? ''),
            'बस्तुगत अनुदान सम्बन्धी विवरण' => ProjectGrantDetailResource::collection($this->whenLoaded('projectGrantDetails')),
            'योजनाबाट प्रत्यक्ष रुपमा लाभान्वित हुने घरधुरी तथा जनसंख्याको विवरण' => BenefitedMemberDetailResource::collection($this->whenLoaded('benefitedMemberDetails'))
        ];
    }
}
