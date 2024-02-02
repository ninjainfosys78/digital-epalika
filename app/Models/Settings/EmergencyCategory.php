<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EmergencyCategory extends Model
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
        'title',
        'image'
    ];

    public function emergencyNumbers(): HasMany
    {
        return $this->hasMany(EmergencyNumber::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Storage::disk('public')->url($value),
            set: fn ($value) => $value->store('emergencyCategory', 'public'),
        );
    }
}
