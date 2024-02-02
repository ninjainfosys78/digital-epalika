<?php

namespace Modules\EMap\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Organization extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'is_active',
        'is_organization',
        'password',
        'can_work',
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

    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }

    public function scopeOrganization($query)
    {
        return $query->where('is_organization', 1);
    }

    public function scopeNotOrganization($query)
    {
        return $query->where('is_organization', 0);
    }

    public function organizationDetail(): HasOne
    {
        return $this->hasOne(OrganizationDetail::class);
    }

    public function mapApplies(): HasMany
    {
        return $this->hasMany(MapApply::class);
    }

    // public function canWorkUntilDate($validityDurationInDays): string
    // {
    //     $expiryDate = Carbon::create(null, 4, 1, 0, 0, 0);
    //     $expiryDate->addDays($validityDurationInDays);
    //     if (!$this->can_work) {
    //         $expiryDate = Carbon::now();
    //     }

    //     return $expiryDate->toDateString();
    // }
}
