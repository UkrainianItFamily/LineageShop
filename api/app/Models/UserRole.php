<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class UserRole.
 *
 * @property int $id
 * @property int $type
 */
class UserRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'type',
    ];

    protected $hidden =
    [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
