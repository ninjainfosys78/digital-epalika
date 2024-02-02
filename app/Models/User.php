<?php

namespace App\Models;

use App\Models\Settings\Branch;
use App\Models\Settings\Employee;
use App\Models\Settings\LetterHead;
use App\Models\UserManagement\Role;
use App\Traits\EventObserveTrait;
use App\Traits\LockableTrait;
use App\Traits\QueryFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Avatar;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\TaskManagement\Entities\Activity;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use QueryFilterTrait;
    use EventObserveTrait;
    use LockableTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'role_id',
        'is_active',
        'password',
        'ward_no',
        'profile_photo_path',
        'pin',
        'employee_id',
        'branch_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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

    public function setPinAttribute($value): void
    {
        if (!empty($value)) {
            $this->attributes['pin'] = bcrypt($value);
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

    public function scopeFilter($query, $param = [])
    {
        $this->filterByUserRole($query, $param);

        return $query;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function users(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function getAvatarAttribute(): string
    {
        $name = $this->attributes['name'] ?? 'User';
        return (new Avatar())->create($name)->toBase64();
    }

    public function letterHead(): MorphOne
    {
        return $this->morphOne(LetterHead::class, 'model');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }



    public function mapPassGroups(): BelongsToMany
    {
        return $this->belongsToMany(\Modules\EMap\Entities\MapPassGroup::class);
    }
    public function complaintApplications()
    {
        return $this->hasMany(ComplaintApplication::class, 'assigned_user_id');
    }
}
