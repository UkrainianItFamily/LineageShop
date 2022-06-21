<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use App\Actions\Response;

class UpdateProductResponse implements Response
{
    private Product $updatedProduct;

    public function __construct(Product $newProduct)
    {
        $this->updatedProduct = $newProduct;
    }

    public function getResponse(): Product
    {
        return $this->updatedProduct;
    }
}
