<?php

namespace Modules\DigitalBoard\Entities;

use App\Models\File;
use App\Models\User;
use App\Traits\EventObserveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopUpNotice extends Model
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
        'date',
        'description',
        'closed_at',
        'show_on_index',
        'user_id',
        'type',
        'fiscal_year_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }


    public function scopeShowInIndex($builder)
    {
        return $builder->where('show_on_index', 1);
    }

    public function scopeHideInIndex($builder)
    {
        return $builder->where('show_on_index', 0);
    }

    public function scopeNullClosedAt($builder)
    {
        return $builder->whereNull('closed_at');
    }

    public function scopeContentType($builder, string $type)
    {
        return $builder->where('type', $type);

    }
}
