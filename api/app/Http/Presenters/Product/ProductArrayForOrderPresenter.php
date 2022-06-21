<?php

namespace App\Http\Presenters\Product;

use App\Models\Product;
use App\Http\Presenters\PropertyValues\PropertyValueAsArrayPresenter;

class ProductArrayForOrderPresenter
{
    private PropertyValueAsArrayPresenter $propertyValueAsArrayPresenter;

    public function __construct(PropertyValueAsArrayPresenter $propertyValueAsArrayPresenter)
    {
        $this->propertyValueAsArrayPresenter = $propertyValueAsArrayPresenter;
    }

    public function present(Product $product): array
    {
        (array) $arrayProduct = [
            'id' => $product->getId(),
            'categoryId' => $product->getCategoryId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'active' => $product->getActive(),
            'availability' => $product->getAvailability(),
            'level' => $product->getLevel(),
            'propertiesValue' => ($product->propertyValues->isNotEmpty())
                ? $this->propertyValueAsArrayPresenter
                    ->presentCollection($product->propertyValues)
                : null,
            'profession' => $product->getProfession(),
            'shortDescription' => $product->getShortDescription(),
            'equipment' => [
                'value' => ($product->equipment->isNotEmpty())
                    ? $product->equipment->first()->value
                    : null,
                'id' => $product->getEquipmentId()
            ],
            'subProperty' => [
                'value' => ($product->subProperty->isNotEmpty())
                    ? $product->subProperty->first()->value
                    : null,
                'id' => $product->getSubPropertyId()
            ],
            'race' => [
                'value' => ($product->race->isNotEmpty())
                    ? $product->race->first()->value
                    : null,
                'id' => $product->getRaceId()
            ],
            'rank' => [
                'value' => ($product->rank->isNotEmpty())
                    ? $product->rank->first()->value
                    : null,
                'id' => $product->getRankId()
            ],
            'property' => [
                'value' => ($product->propertyValues->isNotEmpty())
                    ? $product->propertyValues
                    : null,
                'id' => $product->getPropertyId()
            ],
            'type' => [
                'value' => ($product->type->isNotEmpty())
                    ? $product->type->first()->value
                    : null,
                'id' => $product->getTypeId()
            ]
        ];

        return $arrayProduct;
    }
}
