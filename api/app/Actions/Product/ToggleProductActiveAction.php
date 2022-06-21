<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Constant\DefaultConstant;
use App\Repositories\Product\ProductRepository;
use App\Exceptions\Product\ProductNotFoundException;

class ToggleProductActiveAction
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(GetProductByIdRequest $request): GetProductByIdResponse
    {
        $currentProduct = $this->productRepository->getById($request->getId());

        if (!$currentProduct) {
            throw new ProductNotFoundException();
        }

        if ($currentProduct->getActive() === DefaultConstant::TRUE) {
            $currentProduct->active = DefaultConstant::FALSE;
        } elseif ($currentProduct->getActive() === DefaultConstant::FALSE) {
            $currentProduct->active = DefaultConstant::TRUE;
        }
        $patchedProduct = $this->productRepository->save($currentProduct);

        return new GetProductByIdResponse($patchedProduct);
    }
}
