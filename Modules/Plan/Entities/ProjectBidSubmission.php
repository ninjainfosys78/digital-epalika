<?php

namespace Modules\Plan\Entities;

use App\Models\Settings\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Plan\Enums\BidSubmissionTypeEnum;

class ProjectBidSubmission extends Model
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
        'fiscal_year_id',
        'submission_type',
        'submission_no',
        'date',
        'amount'
    ];

    protected $casts = [
        'submission_type' => BidSubmissionTypeEnum::class
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
