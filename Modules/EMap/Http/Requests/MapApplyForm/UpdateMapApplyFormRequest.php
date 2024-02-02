<?php

namespace Modules\EMap\Http\Requests\MapApplyForm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMapApplyFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'application_type' => ['required'],
            'construction_type' => ['required'],
            'usage' => ['required'],
            'building_category' => ['required'],
            'structure_type_id' => ['nullable'],
            'current_storey' => ['required'],
            'future_storey' => ['required'],
            'length' => ['required'],
            'breadth' => ['required'],
            'height' => ['required'],
            'area_of_plinth' => ['required'],
            'organization_id' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'storeyDetails.height' => ['required'],
            'storeyDetails.map_fee_id' => ['required'],
            'storeyDetails.area_of_proposed_construction' => ['required'],
            'storeyDetails.area_of_former_construction' => ['required'],
            'storeyDetails.total_area' => ['required'],
            'landDetail.land_use_area' => ['required'],
            'landDetail.ward_no' => ['required'],
            'landDetail.former_ward_no' => ['required'],
            'landDetail.tole' => ['required'],
            'landDetail.street_code_no' => ['required'],
            'landDetail.plot_no' => ['required'],
            'landDetail.unit_value' => ['required'],
            'landDetail.percentage_of_area_covered_by_building' => ['required'],
            'landOwner.land_owner_type' => ['required'],
            'landOwner.name' => ['required'],
            'landOwner.phone' => ['required'],
            'landOwner.father_name' => ['required'],
            'landOwner.grandfather_name' => ['required'],
            'landOwner.citizenship_no' => ['required'],
            'landOwner.citizenship_issue_district_id' => ['required'],
            'landOwner.address' => ['required'],
            'landOwner.local_body' => ['required'],
            'landOwner.ward_no' => ['required'],
            'houseOwner.name' => ['required'],
            'houseOwner.phone' => ['required'],
            'houseOwner.father_name' => ['required'],
            'houseOwner.grandfather_name' => ['required'],
            'houseOwner.citizenship_no' => ['required'],
            'houseOwner.citizenship_issue_district_id' => ['required'],
            'houseOwner.address' => ['required'],
            'houseOwner.local_body' => ['required'],
            'houseOwner.ward_no' => ['required'],
            'applicantDetail.applicant_type' => ['required'],
            'applicantDetail.relation_with_owner' => ['required'],
            'applicantDetail.name' => ['required'],
            'applicantDetail.phone' => ['required'],
            'applicantDetail.father_name' => ['required'],
            'applicantDetail.citizenship_no' => ['required'],
            'applicantDetail.citizenship_issue_district_id' => ['required'],
            'applicantDetail.address' => ['required'],
            'applicantDetail.application_date' => ['required'],
            'applicantDetail.signature' => ['nullable'],


        ];

    }
}
