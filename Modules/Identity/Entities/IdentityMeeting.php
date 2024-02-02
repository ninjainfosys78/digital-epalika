<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Identity\Traits\IdentityMinuteTemplateTrait;

class IdentityMeeting extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use IdentityMinuteTemplateTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'title',
        'date_bs',
        'date_ad',
        'description',
        'minute'
    ];

    public function disabilityCommittees(): BelongsToMany
    {
        return $this->belongsToMany(DisabilityCommittee::class, 'disability_committee_identity_meeting', 'meeting_id', 'committee_id');
    }

    public function invitedGuests(): HasMany
    {
        return $this->hasMany(InvitedGuest::class);
    }

    public function disabilityIdentityCards(): BelongsToMany
    {
        return $this->belongsToMany(DisabilityIdentityCard::class);
    }
}
