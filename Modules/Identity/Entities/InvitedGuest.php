<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class InvitedGuest extends Model
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
        "identity_meeting_id",
        "name",
        "phone",
        "designation",
    ];

    public function identityMeeting(): BelongsTo
    {
        return $this->belongsTo(IdentityMeeting::class);
    }
}
