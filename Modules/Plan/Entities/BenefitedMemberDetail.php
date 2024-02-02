<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class BenefitedMemberDetail extends Model
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
        'ward_no',
        'village',
        'dalit_backward_no',
        'other_households_no',
        'no_of_male',
        'no_of_female',
        'no_of_others'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getTotalHouseholdAttribute()
    {
        return $this->attributes['dalit_backward_no'] + $this->attributes['other_households_no'];
    }
    public function getTotalPopulationAttribute()
    {
        return $this->no_of_male + $this->no_of_female + $this->no_of_others;
    }
}
