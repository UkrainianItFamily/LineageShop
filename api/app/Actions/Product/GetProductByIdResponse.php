<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use App\Actions\Response;

class GetProductByIdResponse implements Response
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getResponse(): Product
    {
        return $this->product;
    }
}
