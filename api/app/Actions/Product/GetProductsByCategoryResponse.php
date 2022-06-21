<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Actions\Response;
use Illuminate\Support\Collection;

class GetProductsByCategoryResponse implements Response
{
    private Collection $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function getResponse(): Collection
    {
        return $this->products;
    }
}
