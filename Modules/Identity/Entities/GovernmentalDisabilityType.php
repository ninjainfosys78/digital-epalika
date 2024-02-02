<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\Identity\Enums\CategoryTypeEnum;

class GovernmentalDisabilityType extends Model
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
        'color',
        'category',
        'position',
        'header_color',
        'font_color',
        'raven_background',
    ];

    protected $casts = [
        'category' => CategoryTypeEnum::class
    ];

    public function disabilityIdentityCards(): HasMany
    {
        return $this->hasMany(DisabilityIdentityCard::class, 'gov_disability_type_id');
    }
}
