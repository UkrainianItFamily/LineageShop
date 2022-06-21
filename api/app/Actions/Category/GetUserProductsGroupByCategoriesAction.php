<?php

declare(strict_types=1);

namespace App\Actions\Category;

use Auth;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Product\Criterion\UserIdCriterion;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\Criterion\IsActiveCriterion;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\Criterion\CategoriesIdCriterion;

final class GetUserProductsGroupByCategoriesAction
{
    private CategoryRepositoryInterface $categoryRepositoryInterface;
    private ProductRepositoryInterface $productRepositoryInterface;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(GetUserProductsGroupByCategoriesRequest $request): GetUserProductsGroupByCategoriesResponse
    {
        if ($request->getUserId()) {
            $user = $this->userRepositoryInterface->getById($request->getUserId());
            if (!$user) {
                throw new UserNotFoundException();
            }

            $userId = $user->getId();
        } else {
            $userId = Auth::id();
        }
        $productCriteria[] = new UserIdCriterion($userId);

        $productCriteria[] = new IsActiveCriterion();

        $products = $this->productRepositoryInterface->findByCriteria(
            $productCriteria,
            $this->productRepositoryInterface::DEFAULT_ORDER_TYPE,
            $this->productRepositoryInterface::DEFAULT_ORDER_DIRECTION
        );

        $categoriesId = $products->keyBy('category_id')->keys()->toArray();

        $categoryCriteria[] = new CategoriesIdCriterion($categoriesId);

        $categories = $this->categoryRepositoryInterface->findByCriteria($categoryCriteria);

        $categories->map(function ($category) use ($products) {
            return $category->userProducts = $products
                    ->where('category_id', '=', $category->id)->values();
        });

        return new GetUserProductsGroupByCategoriesResponse($categories);
    }
}
