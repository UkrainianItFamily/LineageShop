<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  Class PropertyDefaultValue.
 *
 *
 * @property int $id
 * @property int $property_id
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class PropertyDefaultValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'property_id',
        'value',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(PropertyValue::class, 'value_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPropertyId(): int
    {
        return $this->property_id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
