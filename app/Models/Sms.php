<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JsonException;

class Sms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'api_used',
        'phone',
        'message',
        'response_data',
    ];

    public function getAllPhoneAttribute(): array
    {
        return explode(',', $this->attributes['phone']);
    }

    /**
     * @throws JsonException
     */
    public function getDetailResponseAttribute(): array
    {
        return json_decode($this->attributes['response_data'], false, 512, JSON_THROW_ON_ERROR);
    }
}
