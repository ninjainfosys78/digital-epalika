<?php

namespace App\Models\Settings\Units;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitConversion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'conversion_from',
        'conversion_to',
        'rate',
    ];

    protected $casts = [
        'rate' => 'double',
    ];

    public function conversionFrom(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'conversion_from');
    }

    public function conversionTo(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'conversion_to');
    }
}
