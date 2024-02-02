<?php

namespace Modules\Identity\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeSignature extends Model
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
        'name',
        'name_en',
        'designation_en',
        'designation',
        'pin',
        'black_signature',
        'red_signature',
        'stamp',
        'status'
    ];


    protected function BlackSignature(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('employeeSignature/' . Str::slug($this->attributes['name_en'], '_'), 'public')
                : null
        );
    }

    protected function RedSignature(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('employeeSignature/' . Str::slug($this->attributes['name_en'], '_'), 'public')
                : null
        );
    }

    protected function Stamp(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                Storage::disk('public')->url($value)
                : '',
            set: fn ($value) => (!empty($value) && !is_string($value))
                ? $value->store('employeeSignature/' . Str::slug($this->attributes['name_en'], '_'), 'public')
                : null
        );
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
}
