<?php

namespace Modules\JudicialCommittee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class ComplaintSubject extends Model
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
        'lawsuit_nature_id',
        'subject'
    ];

    public function lawsuitNature(): BelongsTo
    {
        return $this->belongsTo(LawsuitNature::class);
    }

    public function complaintApplications(): HasMany
    {
        return $this->hasMany(ComplaintApplication::class);
    }
}
