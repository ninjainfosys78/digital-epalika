<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class ProjectBidDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'project_id',
        'bid_no',
        'cost_estimation',
        'notice_published_date',
        'newspaper_name',
        'contract_evaluation_decision_date',
        'intent_notice_publish_date',
        'contract_newspaper_name',
        'contract_acceptance_decision_date',
        'contract_percentage',
        'contractor_name',
        'contractor_address',
        'contractor_phone',
        'confession_number',
        'contract_agreement_date',
        'contract_assigned_date',
        'bid_bond_amount',
        'bid_bond_no',
        'bid_bond_bank_name',
        'bid_bond_issue_date',
        'bid_bond_expiry_date',
        'performance_bond_no',
        'performance_bond_amount',
        'performance_bond_bank',
        'performance_bond_issue_date',
        'performance_bond_expiry_date',
        'performance_bond_extended_date',
        'insurance_issue_date',
        'insurance_expiry_date',
        'insurance_extended_date'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
