<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Modules\BusinessRegistration\Entities\BusinessDetail;
use Modules\EMap\Entities\MapApply;
use Modules\GrievanceHandling\Entities\GrievanceDetail;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\Recommendation\Entities\SipharishCreate;
use Modules\Roaster\Entities\Trainee;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Revenue\Entities\TaxPayer;

class MobileUser extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'is_active',
        'password',
        'tax_prayer_id',
        'approved_at',
        'avatar'

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



    /*   public function setProfilePhotoPathAttribute($value): void
       {
           if (!empty($value) && !is_string($value)) {
               $this->attributes['profile_photo_path'] = $value->store('user/profile/' . Str::slug($this->attributes['name'], '_'), 'public');
           }
       }*/

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }

    public function mapApplies(): HasMany
    {
        return $this->hasMany(MapApply::class);
    }

    public function grievanceDetails(): HasMany
    {
        return $this->hasMany(GrievanceDetail::class);
    }

    public function businessDetails(): HasMany
    {
        return $this->hasMany(BusinessDetail::class);
    }

    public function complaintRegistrations(): HasMany
    {
        return $this->hasMany(ComplaintApplication::class);
    }

    public function trainees(): HasMany
    {
        return $this->hasMany(Trainee::class);
    }
    public function sipharishCreates(): HasMany
    {
        return $this->hasMany(SipharishCreate::class);
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!empty($value) && Storage::disk('public')->exists($value)) {
                    return Storage::disk('public')->url($value);
                }

                return asset('assets/backend/images/user_icon.jpg');
            },
            set: function ($value) {
                if (!empty($value) && !is_string($value)) {
                    return $value->store('mobileUser', 'public');
                }
            }
        );
    }

    public function taxPayer(): BelongsTo
    {
        return $this->belongsTo(TaxPayer::class);
    }


    public function mobileUserDetail(): HasMany
    {
        return $this->hasMany(MobileUserDetail::class);
    }
}
