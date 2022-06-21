<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetCategoryWithProductsResponse implements Response
{
    private Collection $categoriesWithProducts;

    public function __construct(Collection $categoriesWithProducts)
    {
        $this->categoriesWithProducts = $categoriesWithProducts;
    }

    public function getResponse(): Collection
    {
        return $this->categoriesWithProducts;
    }
}
