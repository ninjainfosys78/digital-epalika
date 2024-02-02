<?php

namespace Modules\GrievanceHandling\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrievanceAssignHistory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EventObserveTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'assigned_at'
    ];

    protected $fillable = [
        'grievance_detail_id',
        'from_user_id',
        'user_id'
    ];

    public function grievanceDetail(): BelongsTo
    {
        return $this->belongsTo(GrievanceDetail::class);
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
