<?php

namespace App\Http\Presenters\Product;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductAsArrayPresenter
{
    public function present(Product $product): array
    {
        (array) $arrayProduct = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'categoryId' => $product->getCategoryId(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'active' => $product->getActive(),
            'availability' => $product->getAvailability(),
        ];

        return $arrayProduct;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Product $product) {
                    return $this->present($product);
                }
            )
            ->all();
    }
}
