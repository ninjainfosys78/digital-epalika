<?php

namespace Modules\EMap\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventObserveTrait;

class MapPassGroup extends Model
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
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function scopeStatus(Builder $builder, bool $status = true): void
    {
        $builder->where('status', $status);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

}
