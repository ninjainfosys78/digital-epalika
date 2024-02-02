<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class DisabilityType extends Model
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
        'title',
        'title_en',
        'disability_type_id'
    ];

    public function disabilityIdentityCards(): HasMany
    {
        return $this->hasMany(DisabilityIdentityCard::class);
    }

    public function disabilityTypes(): HasMany
    {
        return $this->hasMany(DisabilityType::class);
    }

    public function disabilityType(): BelongsTo
    {
        return $this->belongsTo(DisabilityType::class);
    }
}
