<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  Class Property.
 *
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property int $category_id
 * @property int $parent_id
 * @property bool $sortable
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'category_id',
        'parent_id',
        'display_in_product_list',
        'sortable',
        'parent_value_id'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Property::class, 'parent_id', 'id');
    }

    public function propertyDefaultValues(): HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class);
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function getSortable(): bool
    {
        return $this->sortable;
    }

    public function getDisplayInProductList(): bool
    {
        return $this->display_in_product_list;
    }

    public function getInputName(): string
    {
        return $this->input_name;
    }

    public function getParentDefaultValue(): ?int
    {
        return $this->parent_value_id;
    }
}
