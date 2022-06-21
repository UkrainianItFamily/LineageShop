<?php

namespace App\Http\Presenters\Category;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Http\Presenters\Property\PropertyAsArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class CategoriesAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private PropertyAsArrayPresenter $propertyAsArrayPresenter;

    public function __construct(PropertyAsArrayPresenter $propertyAsArrayPresenter)
    {
        $this->propertyAsArrayPresenter = $propertyAsArrayPresenter;
    }

    public function present(Category $category): array
    {
        $arrayCategory = [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            'description' => $category->getDescription(),
            'hasNicknameInOrder' => $category->getHasNicknameInOrder(),
            'hasAmountCurrencyInOrder' => $category->getHasAmountCurrencyInOrder(),
            'hasAvailability' => $category->getHasAvailability(),
            'sellButtonName' => $category->getSellButtonName(),
            'productsCount' => count($category->products->where('active', '=', true)),
            'properties' => ($category->properties->isNotEmpty())
                ? $this->propertyAsArrayPresenter->presentCollection($category->properties)
                : null,
        ];
        return $arrayCategory;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Category $category) {
                    return $this->present($category);
                }
            )
            ->all();
    }
}
