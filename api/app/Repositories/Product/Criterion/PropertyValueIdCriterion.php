<?php

declare(strict_types=1);

namespace App\Repositories\Product\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class PropertyValueIdCriterion
{
    private string $propertyId;
    private string $valueId;

    public function __construct(string $propertyId, string $valueId)
    {
        $this->propertyId = $propertyId;
        $this->valueId = $valueId;
    }

    public function apply(Builder $builder): Builder
    {
        $propertyId = $this->propertyId;
        $valueId = $this->valueId;

        return $builder
            ->join("property_values as prop_{$propertyId}", function ($join) use ($propertyId, $valueId) {
                $join->on('products.id', '=', "prop_{$propertyId}.product_id")
                    ->where("prop_{$propertyId}.property_id", $propertyId)
                    ->where("prop_{$propertyId}.value_id", $valueId);
            });
    }
}
