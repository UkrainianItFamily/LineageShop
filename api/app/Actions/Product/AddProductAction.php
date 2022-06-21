<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Constant\ProductConstant;
use App\Exceptions\Product\ProductAlreadyExistException;
use App\Repositories\Product\Criterion\CategoryIdCriterion;
use App\Repositories\Product\Criterion\UserIdCriterion;
use Auth;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

final class AddProductAction
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(AddProductRequest $request): AddProductResponse
    {
        if($request->getCategoryId() === ProductConstant::ADENA_CATEGORY_ID) {
            $criteria[] = new CategoryIdCriterion($request->getCategoryId());
            $criteria[] = new UserIdCriterion(Auth::id());

            $product = $this->productRepository->checkExistByCriteria($criteria);

            if($product) {
                throw new ProductAlreadyExistException();
            }
        }

        $newProduct = new Product();
        $newProduct->name = $request->getName();
        $newProduct->description = $request->getDescription();
        $newProduct->category_id = $request->getCategoryId();
        $newProduct->user_id = Auth::id();
        $newProduct->price = $request->getPrice();
        $newProduct->active = $request->getActive();
        $newProduct->availability = $request->getAvailability();
        $newProduct->equipment_id = $request->getEquipmentId();
        $newProduct->profession = $request->getProfession();
        $newProduct->property_id = $request->getPropertyId();
        $newProduct->race_id = $request->getRaceId();
        $newProduct->rank_id = $request->getRankId();
        $newProduct->short_description = $request->getShortDescription();
        $newProduct->sub_property_id = $request->getSubPropertyId();
        $newProduct->type_id = $request->getTypeId();
        $newProduct->level = $request->getLevel();

        $this->productRepository->save($newProduct);

        return new AddProductResponse($newProduct);
    }
}
