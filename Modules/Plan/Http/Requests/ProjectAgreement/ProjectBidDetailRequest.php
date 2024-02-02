<?php

namespace Modules\Plan\Http\Requests\ProjectAgreement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;

class ProjectBidDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bid_no' => ['nullable'],
            'cost_estimation' => ['required', 'numeric'],
            'notice_published_date' => ['required'],
            'newspaper_name' => ['nullable'],
            'contract_evaluation_decision_date' => ['nullable'],
            'intent_notice_publish_date' => ['nullable'],
            'contract_newspaper_name' => ['nullable'],
            'contract_acceptance_decision_date' => ['nullable'],
            'contract_percentage' => ['required', 'numeric'],
            'contractor_name' => ['nullable'],
            'contractor_address' => ['nullable'],
            'contractor_phone' => ['nullable'],
            'confession_number' => ['nullable'],
            'contract_agreement_date' => ['nullable'],
            'contract_assigned_date' => ['nullable'],
            'bid_bond_amount' => ['nullable', 'numeric'],
            'bid_bond_no' => ['nullable'],
            'bid_bond_bank_name' => ['nullable'],
            'bid_bond_issue_date' => ['nullable'],
            'bid_bond_expiry_date' => ['nullable'],
            'performance_bond_no' => ['nullable'],
            'performance_bond_amount' => ['nullable', 'numeric'],
            'performance_bond_bank' => ['nullable'],
            'performance_bond_issue_date' => ['nullable'],
            'performance_bond_expiry_date' => ['nullable'],
            'performance_bond_extended_date' => ['nullable'],
            'insurance_issue_date' => ['nullable'],
            'insurance_expiry_date' => ['nullable'],
            'insurance_extended_date' => ['nullable'],
            'contract_date' => ['required'],
            'operated_through' => ['required', new Enum(ProjectOperatedThroughEnum::class)],
            'project_start_date' => ['required'],
            'project_completion_date' => ['required', 'after:project_start_date'],
        ];
    }
}
