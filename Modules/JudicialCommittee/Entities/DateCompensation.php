<?php

namespace Modules\JudicialCommittee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class DateCompensation extends Model
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
        'complaint_application_id',
        'decision_date',
        'decision_subject',
        'decision_time',
        'submitted_date',
    ];

    public function complaintApplication(): BelongsTo
    {
        return $this->belongsTo(ComplaintApplication::class);
    }
}
