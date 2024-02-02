<?php

namespace Modules\TaskManagement\Entities;

use App\Models\Settings\Branch;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use App\Traits\NepaliDateConverter;
use Modules\TaskManagement\Enums\ActivityTypeEnum;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;
    use NepaliDateConverter;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_en',
    ];

    protected $fillable = [
        'date',
        'date_en',
        'branch_id',
        'user_id',
        'fiscal_year_id',
        'remarks',
        'activity_type',
        'month_range'
    ];

    protected $appends = [
        'month'
    ];

    protected $casts = [
        'activity_type' => ActivityTypeEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function activityLists(): HasMany
    {
        return $this->hasMany(ActivityList::class);
    }

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(AssignedTask::class);
    }

    public function getMonthAttribute()
    {
        switch ($this->activity_type?->value) {
            case "monthly":
                $data = $this->month_name[$this->attributes["month_range"] - 1];
                break;
            case "tri_monthly":
                $data = $this->triMonthlyQuarters()[$this->attributes["month_range"] - 1]['quarter'];
                break;
            case "quarterly":
                $data = $this->quarters()[$this->attributes["month_range"] - 1]['quarter'];
                break;
            default:
                $data = null;
        }
        return $data;
    }
}
