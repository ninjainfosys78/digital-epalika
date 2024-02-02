<?php

namespace Modules\Plan\Entities;

use App\Models\File;
use App\Models\Settings\FiscalYear;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\ProjectOperatedThroughEnum;
use Modules\Plan\Enums\ProjectStatusEnum;
use Modules\Plan\Traits\PlanTemplateTrait;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use PlanTemplateTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'registration_no',
        'fiscal_year_id',
        'project_name',
        'expense_head_id',
        'plan_area_id',
        'project_status',
        'project_start_date',
        'project_completion_date',
        'plan_level_id',
        'ward_no',
        'project_venue',
        'evaluation_amount',
        'purpose',
        'operated_through',
        'is_contracted',
        'contract_date',
        'progress_spent_amount',
        'physical_progress_target',
        'physical_progress_completed',
        'physical_progress_unit',
        'first_quarterly_amount',
        'first_quarterly_goal',
        'second_quarterly_amount',
        'second_quarterly_goal',
        'third_quarterly_amount',
        'third_quarterly_goal',
        'estimated_total_cost',
        'agencies_grants',
        'share_amount',
        'committee_share_amount',
        'contingency_amount',
        'other_taxes',
        'labor_amount',
        'benefited_organization',
        'others_benefited'
    ];

    protected $casts = [
        'project_status' => ProjectStatusEnum::class,
        'operated_through' => ProjectOperatedThroughEnum::class,
        'agencies_grants' => 'int',
        'share_amount' => 'int',
        'committee_share_amount' => 'int',

    ];

    protected $appends = [
        'total_amount_for_contingency',
        'contingency_percent',
        'project_contract_amount',
        'total_cost_estimate_amount'
    ];

    public function getTotalAmountForContingencyAttribute(): float
    {
        $this->loadSum('projectAllocatedAmounts', 'amount');
        return round($this->project_allocated_amounts_sum_amount + $this->agencies_grants + $this->share_amount + $this->committee_share_amount, 2);
    }

    public function getContingencyPercentAttribute(): float
    {
        return $this->total_amount_for_contingency > 0 ? round($this->contingency_amount * 100 / $this->total_amount_for_contingency, 2) : 0;
    }

    public function getProjectContractAmountAttribute(): float
    {
        return round($this->total_amount_for_contingency - $this->contingency_amount - $this->other_taxes, 2);
    }

    public function getTotalCostEstimateAmountAttribute(): float
    {
        return round($this->project_contract_amount + $this->labor_amount, 2);
    }

    protected function wardNo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode(",", $value),
            set: fn ($value) => implode(",", $value),
        );
    }


    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function planArea(): BelongsTo
    {
        return $this->belongsTo(PlanArea::class);
    }

    public function expenseHead(): BelongsTo
    {
        return $this->belongsTo(ExpenseHead::class);
    }

    public function planLevel(): BelongsTo
    {
        return $this->belongsTo(PlanLevel::class);
    }

    public function budgetHead(): BelongsTo
    {
        return $this->belongsTo(BudgetHead::class);
    }

    public function projectGrantDetails(): HasMany
    {
        return $this->hasMany(ProjectGrantDetail::class);
    }

    public function benefitedMemberDetails(): HasMany
    {
        return $this->hasMany(BenefitedMemberDetail::class);
    }

    public function consumerCommittee(): HasOne
    {
        return $this->hasOne(ConsumerCommittee::class);
    }

    public function projectInstallmentDetails(): HasMany
    {
        return $this->hasMany(ProjectInstallmentDetail::class);
    }

    public function projectMaintenanceArrangement(): HasOne
    {
        return $this->hasOne(ProjectMaintenanceArrangement::class);
    }

    public function projectAgreementTerm(): HasOne
    {
        return $this->hasOne(ProjectAgreementTerm::class);
    }

    public function projectBidDetail(): HasOne
    {
        return $this->hasOne(ProjectBidDetail::class);
    }

    public function projectDeadlineExtensions(): HasMany
    {
        return $this->hasMany(ProjectDeadlineExtension::class);
    }

    public function projectBidSubmissions(): HasMany
    {
        return $this->hasMany(ProjectBidSubmission::class);
    }

    public function projectDocuments(): HasMany
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function consumerCommitteeTransactions(): HasMany
    {
        return $this->hasMany(ConsumerCommitteeTransaction::class);
    }

    public function technicalCostEstimates(): HasMany
    {
        return $this->hasMany(TechnicalCostEstimate::class);
    }

    public function projectAllocatedAmounts(): HasMany
    {
        return $this->hasMany(ProjectAllocatedAmount::class);
    }
}
