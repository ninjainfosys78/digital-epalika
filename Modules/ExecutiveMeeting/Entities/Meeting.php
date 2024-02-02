<?php

namespace Modules\ExecutiveMeeting\Entities;

use App\Models\Settings\FiscalYear;
use App\Models\User;
use App\Traits\GetAllColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\ExecutiveMeeting\Enums\RecurrenceTypeEnum;

class Meeting extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use GetAllColumns;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'committee_id',
        'meeting_id',
        'meeting_name',
        'recurrence',
        'start_date',
        'en_start_date',
        'end_date',
        'en_end_date',
        'recurrence_end_date',
        'en_recurrence_end_date',
        'description',
        'user_id',
        'fiscal_year_id',
        'is_print'
    ];

    protected $casts = [
        'recurrence' => RecurrenceTypeEnum::class,
    ];

    public function committee(): BelongsTo
    {
        return $this->belongsTo(Committee::class);
    }

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function meetingAgendas(): HasMany
    {
        return $this->hasMany(MeetingAgenda::class);
    }

    public function meetingDecisions(): HasMany
    {
        return $this->hasMany(MeetingDecision::class);
    }

    public function meetingDecision(): HasOne
    {
        return $this->hasOne(MeetingDecision::class);
    }

    public function invitedMembers(): HasMany
    {
        return $this->hasMany(InvitedMember::class);
    }

    public function meetingMinute(): HasOne
    {
        return $this->hasOne(MeetingMinute::class);
    }

    public function meetingParticipants(): HasMany
    {
        return $this->hasMany(MeetingParticipant::class);
    }
}
