<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;

class ExperienceFile extends Model
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
        'employee_id',
        'title',
        'file',
    ];

    public function setFileAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['file'] = $value->store('experienceFile', 'public');
        }
    }

    public function getFileAttribute(): string
    {
        return $this->attributes['file'] ? Storage::disk('public')->url($this->attributes['file']) : '';
    }
}
