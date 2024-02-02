<?php

namespace Modules\DigitalBoard\Entities;

use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Video extends Model
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
        'title',
        'video',
    ];

    public function getVideoUrlAttribute(): string
    {
        return ($this->attributes['video'] && Storage::disk('public')->exists($this->attributes['video']))
            ? Storage::disk('public')->url($this->attributes['video'])
            : asset('default/noVideo.webp');
    }
}
