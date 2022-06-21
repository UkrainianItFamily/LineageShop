<?php

declare(strict_types=1);

namespace App\Actions\Product;

use Auth;
use App\Repositories\Product\Criterion\UserIdCriterion;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\Criterion\CategoryIdCriterion;

final class GetProductsByUserAction
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface
    ) {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function execute(GetProductsByUserRequest $request): GetProductsByUserResponse
    {
        $criteria[] = new UserIdCriterion(Auth::id());

        if ($request->getCategoryId()) {
            $criteria[] = new CategoryIdCriterion($request->getCategoryId());
        }

        $products = $this->productRepositoryInterface->findByCriteria(
            $criteria,
            $request->getOrderType() ?: $this->productRepositoryInterface::DEFAULT_ORDER_TYPE,
            $request->getOrderDirection() ?: $this->productRepositoryInterface::DEFAULT_ORDER_DIRECTION
        );

        return new GetProductsByUserResponse($products);
    }
}
