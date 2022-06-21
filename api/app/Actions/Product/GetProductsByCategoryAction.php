<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\Criterion\IsActiveCriterion;
use App\Repositories\Product\Criterion\CategoryIdCriterion;
use App\Repositories\Product\Criterion\ProductNameCriterion;
use App\Repositories\Product\Criterion\PropertyValueCriterion;
use App\Repositories\Product\Criterion\PropertyValueIdCriterion;

final class GetProductsByCategoryAction
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(GetProductsByCategoryRequest $request): GetProductsByCategoryResponse
    {
        $criteria[] = new CategoryIdCriterion($request->getCategoryId());

        $criteria[] = new IsActiveCriterion();

        if ($request->getName()) {
            $criteria[] = new ProductNameCriterion($request->getName());
        }

        if ($request->getProperties()) {
            foreach ($request->getProperties() as $property) {
                if (isset($property['valueId'])) {
                    $criteria[] = new PropertyValueIdCriterion($property['propertyId'], $property['valueId']);
                } elseif (isset($property['value'])) {
                    $criteria[] = new PropertyValueCriterion($property['propertyId'], $property['value']);
                }
            }
        }

        $products = $this->productRepository->findByCriteria(
            $criteria,
            $request->getOrderType() ?: $this->productRepository::DEFAULT_ORDER_TYPE,
            $request->getOrderDirection() ?: $this->productRepository::DEFAULT_ORDER_DIRECTION
        );

        return new GetProductsByCategoryResponse($products);
    }
}
