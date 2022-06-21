<?php

declare(strict_types=1);

namespace App\Actions\Product;

final class GetProductByIdRequest
{
    private int $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    public function getId(): int
    {
        return $this->productId;
    }
}
