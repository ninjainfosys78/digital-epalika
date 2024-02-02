<?php

namespace Modules\Recommendation\Entities;

use App\Models\File;
use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class RegistrationDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'user_id',
        'registration_no',
        'date_ne',
        'date_en',
        'recommendation_data',
        'personal_detail_id',
        'recommendation_category_id',
        'fiscal_year_id',
        'ward_no',
    ];

    protected $appends = [
        'registration_month'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personalDetail(): BelongsTo
    {
        return $this->belongsTo(PersonalDetail::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function recommendationCategory(): BelongsTo
    {
        return $this->belongsTo(RecommendationCategory::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function Application(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Storage::disk('public')->url($value),
            set: fn ($value) => (!empty($value) && !is_string($value)) ? $value->store('registrationDetail', 'public') : null,
        );
    }

    public function getRegistrationMonthAttribute(): string
    {
        return explode('-', $this->date_ne)[1] ?? '';
    }

    public function scopeFilterData($query)
    {
        if (auth()->user()->role->type !== 'Super') {
            $query->where('user_id', auth()->id());
            $query->where('ward_no', auth()->user()->ward_no);
        }
        return $query;
    }
}
