<?php

namespace Modules\EMap\Entities;

use App\Models\Settings\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Modules\EMap\Enums\CategorizationEnum;
use Modules\EMap\Enums\TypeOfConstructionWorkEnum;

class OldMap extends Model
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
        'application_type',
        'fiscal_year_id',
        'registration_no',
        'registration_fee',
        'registration_date',
        'construction_type',
        'usage',
        'building_category',
    ];

    protected $casts = [
        'construction_type' => TypeOfConstructionWorkEnum::class,
        'building_category' => CategorizationEnum::class,
    ];

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function houseOwner(): BelongsToMany
    {
        return $this->belongsToMany(HouseOwner::class);
    }

}
