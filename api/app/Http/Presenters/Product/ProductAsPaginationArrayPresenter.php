<?php

namespace App\Http\Presenters\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Http\Presenters\User\UserAsArrayForProductPresenter;
use App\Http\Presenters\PropertyValues\PropertyValueAsArrayPresenter;

class ProductAsPaginationArrayPresenter
{
    private UserAsArrayForProductPresenter $userAsArrayForProductPresenter;

    private PropertyValueAsArrayPresenter $propertyValueAsArrayPresenter;

    public function __construct(
        UserAsArrayForProductPresenter $userAsArrayForProductPresenter,
        PropertyValueAsArrayPresenter $propertyValueAsArrayPresenter
    ) {
        $this->userAsArrayForProductPresenter = $userAsArrayForProductPresenter;
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
            'user' => ($product->user)
                ? $this->userAsArrayForProductPresenter
                ->present($product->user)
                : null,
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

    public function presentCollection(Collection $paginator): array
    {
        return $paginator
            ->map(
                function (Product $product) {
                    return $this->present($product);
                }
            )
            ->all();
    }
}
