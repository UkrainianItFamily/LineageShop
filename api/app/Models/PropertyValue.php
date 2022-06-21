<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class PropertyValue.
 *
 *
 * @property int $id
 * @property int $property_id
 * @property int $product_id
 * @property string $value
 * @property int $value_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class PropertyValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'property_id',
        'product_id',
        'value',
        'value_id',
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

    public function propertyDefaultValue(): BelongsTo
    {
        return $this->belongsTo(PropertyDefaultValue::class, 'value_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPropertyId(): int
    {
        return $this->property_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getValueId(): ?int
    {
        return $this->value_id;
    }
}
