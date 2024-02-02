<?php

namespace Modules\Roaster\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MuncipalRegistration extends Model
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
        'trainee_user_detail_id',
        'palika_reg_no',
        'reg_date',
        'file',
    ];

    public function traineeUserDetail(): BelongsTo
    {
        return $this->belongsTo(TraineeUserDetail::class);
    }

    public function getFileUrlAttribute(): string
    {
        return $this->attributes['file']
            ? Storage::disk('public')->url($this->attributes['file'])
            : asset('images/user_icon.jpg');
    }

    public function setFileAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['file'] = $value->store('traineeUser/detail/org/muncipalRegistration', 'public');
        }
    }
}
