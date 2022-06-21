<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Repositories\Product\ProductRepository;
use App\Exceptions\Product\ProductNotFoundException;

final class GetProductByIdAction
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(GetProductByIdRequest $request): GetProductByIdResponse
    {
        $product = $this->productRepository->getById($request->getId());

        if (!$product) {
            throw new ProductNotFoundException();
        }

        return new GetProductByIdResponse($product);
    }
}
