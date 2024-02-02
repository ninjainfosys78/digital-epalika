<?php

namespace Modules\DigitalBoard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class Audio extends Model
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
        'audio',
    ];
    public function getAudioUrlAttribute(): string
    {
        return ($this->attributes['audio'] && Storage::disk('public')->exists($this->attributes['audio']))
            ? Storage::disk('public')->url($this->attributes['audio'])
            : asset('default/noAudio.png');
    }
}
