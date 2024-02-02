<?php

namespace Modules\Grant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class CashGrant extends Model
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
        'address',
        'age',
        'contact',
        'citizenship_no',
        'father_name',
        'grandfather_name',
        'helplessness_type_id',
        'cash',
        'file',
        'remark',
    ];
    public function helplessnessType(): BelongsTo
    {
        return $this->belongsTo(HelplessnessType::class);
    }

}
