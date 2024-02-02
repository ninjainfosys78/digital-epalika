<?php

namespace Modules\Roaster\Entities;

use App\Models\Settings\FiscalYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Roaster\Enums\TrainingTypeEnum;

class Training extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'open_date',
        'closed_date',
    ];

    protected $fillable = [
        'name',
        'open_date',
        'closed_date',
        'closed_at',
        'aim',
        'description',
        'places',
        'pre_max_mark',
        'pre_min_mark',
        'pre_average_mark',
        'post_max_mark',
        'post_min_mark',
        'post_average_mark',
        'fiscal_year_id',
        'included_subjects',
        'trainee_open_date',
        'trainee_closed_date',
        'organization_open_date',
        'organization_closed_date',
    ];

    protected $casts = [
        'form_type' => TrainingTypeEnum::class,
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 'active'); // Assuming 'status' is the column representing the status of the training
    }

    public function trainingTrainees(): HasMany
    {
        return $this->hasMany(TrainingTrainee::class);
    }

    public function getFormStatusAccordingToDateAttribute(): bool
    {
        $openDate = Carbon::parse($this->attributes['open_date'])->format('Y-m-d H:i:s');
        $closeDate = Carbon::parse($this->attributes['closed_date'])->format('Y-m-d H:i:s');
        $today = now()->format('Y-m-d H:i:s');

        return $openDate <= $today && $today <= $closeDate;
    }
    public function getFormStatusAccordingToOrganizationDateAttribute(): bool
    {
        $openDate = Carbon::parse($this->attributes['organization_open_date'])->format('Y-m-d H:i:s');
        $closeDate = Carbon::parse($this->attributes['organization_closed_date'])->format('Y-m-d H:i:s');
        $today = now()->format('Y-m-d H:i:s');

        return $openDate <= $today && $today <= $closeDate;
    }
    public function getFormStatusAccordingToTraineeDateAttribute(): bool
    {
        $openDate = Carbon::parse($this->attributes['trainee_open_date'])->format('Y-m-d H:i:s');
        $closeDate = Carbon::parse($this->attributes['trainee_closed_date'])->format('Y-m-d H:i:s');
        $today = now()->format('Y-m-d H:i:s');

        return $openDate <= $today && $today <= $closeDate;
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'model');
    }
}
