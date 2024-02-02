<?php

namespace Modules\DigitalBoard\Entities;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceEmployee extends Model
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
        'service_id',
        'employee_name',
        'photo',
        'email',
        'phone',
        'designation',
        'position',
    ];

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? Storage::disk('public')->url($this->attributes['photo']) : asset('images/user_icon.jpg');
    }

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('service/'.Str::slug($this->attributes['employee_name'], '_'), 'public');
        }
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
