<?php

namespace Modules\GrievanceHandling\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Avatar\Avatar;

class GrievanceUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'password',
    ];

    public function setPasswordAttribute($value): void
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getAvatarAttribute(): string
    {
        $name = $this->attributes['name'] ?? 'User';
        return (new Avatar())->create($name)->toBase64();
    }

    public function grievanceDetails(): HasMany
    {
        return $this->hasMany(GrievanceDetail::class);
    }
}
