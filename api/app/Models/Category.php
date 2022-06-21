<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  Class Category
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $main_image
 * @property string $second_image
 * @property string $created_at
 * @property bool $has_nickname_in_order
 * @property bool $has_amount_currency_in_order
 * @property bool $has_availability
 * @property string $updated_at
 * @property string $deleted_at
 * @property Collection products
 * @property Collection properties
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'main_image',
        'second_image',
        'has_nickname_in_order',
        'has_amount_currency_in_order',
        'has_availability',
        'sell_button_name',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMainImage(): string
    {
        return $this->main_image;
    }

    public function getSecondImage(): string
    {
        return $this->second_image;
    }

    public function getHasAvailability(): bool
    {
        return $this->has_availability;
    }

    public function getHasNicknameInOrder(): bool
    {
        return $this->has_nickname_in_order;
    }

    public function getHasAmountCurrencyInOrder(): bool
    {
        return $this->has_amount_currency_in_order;
    }

    public function getSellButtonName(): string
    {
        return $this->sell_button_name;
    }
}
