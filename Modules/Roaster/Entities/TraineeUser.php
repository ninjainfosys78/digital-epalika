<?php

namespace Modules\Roaster\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class TraineeUser extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;
    use HasApiTokens;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'is_active',
        'is_trainee',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value): void
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->attributes['profile_photo_path']
            ? Storage::disk('public')->url($this->attributes['profile_photo_path'])
            : asset('images/user_icon.jpg');
    }

    public function setProfilePhotoPathAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['profile_photo_path'] = $value->store('user/profile/' . Str::slug($this->attributes['name'], '_'), 'public');
        }
    }

    public function traineeUserDetail(): HasOne
    {
        return $this->hasOne(TraineeUserDetail::class);
    }
}
