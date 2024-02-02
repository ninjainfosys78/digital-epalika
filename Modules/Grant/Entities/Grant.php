<?php

namespace Modules\Grant\Entities;

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

class Grant extends Model
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
        'fiscal_year_id',
        'grant_type_id',
        'grant_office_id',
        'grant_program_name',
        'branch_id',
        'grant_amount',
        'grant_for',
        'other',
        'main_activity',
        'remarks',
        'user_id',
    ];

    protected $appends = [
        'grant_for_data'
    ];

    public function getGrantForDataAttribute(): array
    {
        return explode(',', $this->attributes['grant_for']);
    }

    public function setGrantForAttribute($value)
    {
        $this->attributes['grant_for'] = implode(',', $value);
    }



    public function grantOffice(): BelongsTo
    {
        return $this->belongsTo(GrantOffice::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function grantType(): BelongsTo
    {
        return $this->belongsTo(GrantType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grantDetails(): HasMany
    {
        return $this->hasMany(GrantDetail::class);
    }
}
