<?php

namespace Modules\Revenue\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class Sector extends Model
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
        'title'
    ];

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }

    public function structureAssessmentRates(): HasMany
    {
        return $this->hasMany(StructureAssessmentRate::class);
    }
}
