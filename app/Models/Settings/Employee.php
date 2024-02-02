<?php

namespace App\Models\Settings;

use App\Enums\Gender;
use App\Models\File;
use App\Models\User;
use App\Models\UserManagement\Role;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'department',
        'designation',
        'photo',
        'email',
        'phone',
        'position',
        'status',
        'is_employee',
        'show_to_mobile_app',
        'show_to_index',
        'employee_id',
        'branch_id',
        'is_dept_head',
        'gender',
        'dob',
        'dob_ad',
        'address',
        'ethnicity_id',
        'pan_no',
        'pis_no',
        'epf_no',
        'cif_no',
        'insurance_card_no',
        'description',
    ];

    protected $casts = [
        'gender' => Gender::class
    ];

    public function getPhotoUrlAttribute(): string
    {
        return $this->attributes['photo']
            ? Storage::disk('public')->url($this->attributes['photo'])
            : asset('images/user_icon.jpg');
    }

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('employee/' . Str::slug($this->attributes['name'], '_'), 'public');
        }
    }

    public function scopeActive($builder)
    {
        return $builder->where('status', 1);
    }

    public function scopeInactive($builder)
    {
        return $builder->where('status', 0);
    }

    public function scopeEmployee($builder)
    {
        return $builder->where('is_employee', 1);
    }

    public function scopePeopleRepresentative($builder)
    {
        return $builder->where('is_employee', 0);
    }

    public function scopeShowForMobileAppRequest($builder)
    {
        return $builder->where('show_to_mobile_app', 1);
    }

    public function scopeHideForMobileAppRequest($builder)
    {
        return $builder->where('show_to_mobile_app', 0);
    }

    public function scopeShowInIndex($builder)
    {
        return $builder->where('show_to_index', 1);
    }

    public function scopeHideInIndex($builder)
    {
        return $builder->where('show_to_index', 0);
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
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
    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }
}
