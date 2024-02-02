<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Carbon;

class ProjectDeadlineExtension extends Model
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
        'extended_date',
        'en_extended_date',
        'submitted_date',
        'en_submitted_date',
        'remarks'
    ];

    protected $appends = [
        'extended_months'
    ];

    public function getExtendedMonthsAttribute(): float|int
    {
        return Carbon::parse($this->en_extended_date)->diffInMonths(Carbon::parse($this->en_submitted_date));
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
