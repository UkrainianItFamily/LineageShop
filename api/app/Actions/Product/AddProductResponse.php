<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use App\Actions\Response;

class AddProductResponse implements Response
{
    private Product $newProduct;

    public function __construct(Product $newProduct)
    {
        $this->newProduct = $newProduct;
    }

    public function getResponse(): Product
    {
        return $this->newProduct;
    }
}
