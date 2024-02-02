<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyNumber extends Model
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
        'contact_no',
        'emergency_category_id',
        'latitude',
        'longitude',
        'contact_person_name',
        'address',
    ];

    public function emergencyCategory(): BelongsTo
    {
        return $this->belongsTo(EmergencyCategory::class);
    }

    public function getGoogleMapsUrlAttribute(): string
    {
        $latitude = (float)$this->attributes['latitude'] ?? 0;
        $longitude = (float)$this->attributes['longitude'] ?? 0;

        // Build Google Maps URL
        return "https://www.google.com/maps?q={$latitude},{$longitude}";
    }
}
