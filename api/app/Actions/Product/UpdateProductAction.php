<?php

declare(strict_types=1);

namespace App\Actions\Product;

use Auth;
use App\Exceptions\Product\ProductNotFoundException;
use App\Repositories\Product\ProductRepositoryInterface;

final class UpdateProductAction
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(UpdateProductRequest $request): UpdateProductResponse
    {
        $updateProduct = $this->productRepository->getById($request->getId());

        if (!$updateProduct) {
            throw new ProductNotFoundException();
        }

        $updateProduct->name = $request->getName();
        $updateProduct->description = $request->getDescription();
        $updateProduct->category_id = $request->getCategoryId();
        $updateProduct->user_id = Auth::id();
        $updateProduct->price = $request->getPrice();
        $updateProduct->active = $request->getActive();
        $updateProduct->availability = $request->getAvailability();
        $updateProduct->equipment_id = $request->getEquipmentId();
        $updateProduct->level = $request->getLevel();
        $updateProduct->profession = $request->getProfession();
        $updateProduct->property_id = $request->getPropertyId();
        $updateProduct->race_id = $request->getRaceId();
        $updateProduct->rank_id = $request->getRankId();
        $updateProduct->short_description = $request->getShortDescription();
        $updateProduct->sub_property_id = $request->getSubPropertyId();
        $updateProduct->type_id = $request->getTypeId();

        $this->productRepository->update($updateProduct);

        return new UpdateProductResponse($updateProduct);
    }
}
