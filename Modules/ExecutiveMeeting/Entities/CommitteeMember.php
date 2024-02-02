<?php

namespace Modules\ExecutiveMeeting\Entities;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommitteeMember extends Model
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
        'committee_id',
        'name',
        'designation',
        'phone',
        'photo',
        'email',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
        'tole',
        'position',
        'user_id'
    ];

    protected function Photo(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Storage::disk('public')->url($value) : asset('assets/backend/images/user_icon.jpg'),
            set: static fn ($value, $attributes) => (!empty($value) && !is_string($value)) ? $value->store('committeeMember/' . Str::slug($attributes['name'], '_'), 'public') : null,
        );
    }

    public function committee(): BelongsTo
    {
        return $this->belongsTo(Committee::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }

    public function meetingParticipants(): HasMany
    {
        return $this->hasMany(MeetingParticipant::class);
    }
}
