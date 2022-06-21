<?php

declare(strict_types=1);

namespace App\Repositories\Product\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class PropertyValueCriterion
{
    private string $propertyId;
    private string $value;

    public function __construct(string $propertyId, string $value)
    {
        $this->propertyId = $propertyId;
        $this->value = $value;
    }

    public function apply(Builder $builder): Builder
    {
        $propertyId = $this->propertyId;
        $value = $this->value;

        return $builder
            ->join("property_values as prop_{$propertyId}", function ($join) use ($propertyId, $value) {
                $join->on('products.id', '=', "prop_{$propertyId}.product_id")
                    ->where("prop_{$propertyId}.property_id", $propertyId)
                    ->where("prop_{$propertyId}.value", $value);
            });
    }
}
