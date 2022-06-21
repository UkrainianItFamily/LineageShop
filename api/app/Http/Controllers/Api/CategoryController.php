<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Actions\Category\GetAllCategoryAction;
use App\Actions\Category\GetCategoryByIdAction;
use App\Actions\Category\GetCategoryByIdRequest;
use App\Http\Presenters\Category\CategoriesAsArrayPresenter;
use App\Actions\Category\GetUserProductsGroupByCategoriesAction;
use App\Actions\Category\GetUserProductsGroupByCategoriesRequest;
use App\Http\Presenters\Category\CategoriesAsArrayForUserPresenter;

class CategoryController extends ApiController
{
    public function getCategories(
        GetAllCategoryAction $getAllCategoryAction,
        CategoriesAsArrayPresenter $categoriesAsArrayPresenter
    ): JsonResponse {
        $categoryCollection = $getAllCategoryAction
            ->execute()
            ->getResponse();

        $presenter = $categoriesAsArrayPresenter->presentCollection($categoryCollection);

        return $this->successResponse($presenter);
    }

    public function getCategoryById(
        GetCategoryByIdAction $getAllCategoryByIdAction,
        CategoriesAsArrayPresenter $categoryAsArrayPresenter,
        string $id
    ): JsonResponse {
        $categoryCollection = $getAllCategoryByIdAction
            ->execute(new GetCategoryByIdRequest((int) $id))
            ->getResponse();

        $presenter = $categoryAsArrayPresenter->present($categoryCollection);

        return $this->successResponse($presenter);
    }

    public function getCategoriesWithProductsForUser(
        GetUserProductsGroupByCategoriesAction $getUserProductsGroupByCategoriesAction,
        CategoriesAsArrayForUserPresenter $categoriesAsArrayForUserPresenter,
        ?string $userId = null
    ): JsonResponse {
        $categoryWithProducts = $getUserProductsGroupByCategoriesAction
            ->execute(new GetUserProductsGroupByCategoriesRequest(
                (int) $userId,
            ))
            ->getResponse();

        $presenter = $categoriesAsArrayForUserPresenter->presentCollection($categoryWithProducts);

        return $this->successResponse($presenter);
    }
}
