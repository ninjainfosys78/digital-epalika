<?php

namespace Modules\Roaster\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class TraineeTaxClearance extends Model
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
        'document',
        'year',
    ];

    public function traineeUserDetail(): BelongsTo
    {
        return $this->belongsTo(TraineeUserDetail::class);
    }

    public function getDocumentUrlAttribute(): string
    {
        return $this->attributes['document']
            ? Storage::disk('public')->url($this->attributes['document'])
            : asset('images/user_icon.jpg');
    }

    public function setDocumentAttribute($value)
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['document'] = $value->store('traineeUser/detail/org/taxClearance', 'public');
        }
    }
}
