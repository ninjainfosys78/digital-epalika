<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class ConsumerCommittee extends Model
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
        'name',
        'address',
        'phone',
        'formation_date',
        'committee_registration_date',
        'meeting_date',
        'registration_no',
        'beneficiary_no',
        'experience_in_project'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function consumerCommitteeOfficials(): HasMany
    {
        return $this->hasMany(ConsumerCommitteeOfficial::class);
    }
}
