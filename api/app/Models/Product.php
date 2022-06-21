<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class Product.
 *
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $profession
 * @property string $short_description
 * @property int $user_id
 * @property int $category_id
 * @property int $price
 * @property int $refresh_time
 * @property int $active
 * @property int $availability
 * @property int $sale_status
 * @property int $equipment_id
 * @property int $level
 * @property int $property_id
 * @property int $race_id
 * @property int $rank_id
 * @property int $sub_property_id
 * @property int $type_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category_id',
        'price',
        'refresh_time',
        'active',
        'availability',
        'sale_status',
        'profession',
        'short_description',
        'equipment_id',
        'level',
        'property_id',
        'race_id',
        'rank_id',
        'sub_property_id',
        'type_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(PropertyValue::class, 'id', 'property_id');
    }

    public function subProperty(): HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class, 'id', 'sub_property_id');
    }

    public function rank(): ?HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class, 'id', 'rank_id');
    }

    public function race(): ?HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class, 'id', 'race_id');
    }

    public function type(): ?HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class, 'id', 'type_id');
    }

    public function equipment(): ?HasMany
    {
        return $this->hasMany(PropertyDefaultValue::class, 'id', 'equipment_id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getRefreshTime(): int
    {
        return $this->refresh_time;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function getSaleStatus(): int
    {
        return $this->sale_status;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function getEquipmentId(): ?int
    {
        return $this->equipment_id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function getPropertyId(): ?int
    {
        return $this->property_id;
    }

    public function getSubPropertyId(): ?int
    {
        return $this->sub_property_id;
    }

    public function getRaceId(): ?int
    {
        return $this->race_id;
    }

    public function getRankId(): ?int
    {
        return $this->rank_id;
    }

    public function getTypeId(): ?int
    {
        return $this->type_id;
    }
}
