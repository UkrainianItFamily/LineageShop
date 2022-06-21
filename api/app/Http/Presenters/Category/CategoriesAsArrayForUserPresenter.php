<?php

namespace App\Http\Presenters\Category;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Http\Presenters\Product\ProductAsArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class CategoriesAsArrayForUserPresenter implements CollectionAsArrayPresenterInterface
{
    private ProductAsArrayPresenter $productAsArrayPresenter;

    public function __construct(ProductAsArrayPresenter $productAsArrayPresenter)
    {
        $this->productAsArrayPresenter = $productAsArrayPresenter;
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
            'userProducts' => $category->userProducts
                ? $this->productAsArrayPresenter->presentCollection($category->userProducts)
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
