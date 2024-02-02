<?php

namespace Modules\GrievanceHandling\Entities;

use App\Models\File;
use App\Models\MobileUser;
use App\Models\Settings\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity;
use Modules\GrievanceHandling\Enums\GrievanceMediumEnum;
use Modules\GrievanceHandling\Enums\GrievanceStatus;

class GrievanceDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'grievance_detail_id',
        'token',
        'grievance_user_id',
        'user_id',
        'grievance_type_id',
        'branch_id',
        'publisher_id',
        'assigned_user_id',
        'assigned_at',
        'subject',
        'description',
        'complaint_severity',
        'is_open',
        'status',
        'is_approved',
        'is_public',
        'grievance_medium',
        'is_anonymous',
        'mobile_user_id'
    ];

    protected $casts = [
        'complaint_severity' => GrievanceComplaintSeverity::class,
        'status' => GrievanceStatus::class,
        'grievance_medium' => GrievanceMediumEnum::class
    ];

    public function scopeAnonymous($query)
    {
        return $query->where('is_anonymous', 1);
    }

    public function scopeNotAnonymous($query)
    {
        return $query->where('is_anonymous', 0);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function scopeNotApproved($query)
    {
        return $query->where('is_approved', 0);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', 1);
    }

    public function scopeNotPublic($query)
    {
        return $query->where('is_public', 0);
    }

    public function grievanceDetail(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function mobileUser(): BelongsTo
    {
        return $this->belongsTo(MobileUser::class);
    }

    public function grievanceDetails(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function grievanceUser(): BelongsTo
    {
        return $this->belongsTo(GrievanceUser::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grievanceType(): BelongsTo
    {
        return $this->belongsTo(GrievanceType::class);
    }


    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    public function grievanceAssignHistories(): HasMany
    {
        return $this->hasMany(GrievanceAssignHistory::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

}
