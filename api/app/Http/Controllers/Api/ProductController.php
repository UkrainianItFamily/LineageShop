<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Product\AddProductAction;
use App\Actions\Product\AddProductRequest;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Actions\Product\DeleteProductRequest;
use App\Actions\Product\GetProductByIdAction;
use App\Actions\Product\UpdateProductRequest;
use App\Actions\Product\GetProductByIdRequest;
use App\Actions\Product\GetProductsByUserAction;
use App\Actions\Product\GetProductsByUserRequest;
use App\Actions\Product\ToggleProductActiveAction;
use App\Actions\Product\GetProductsByCategoryAction;
use App\Actions\Product\GetProductsByCategoryRequest;
use App\Http\Requests\Product\ProductValidateRequest;
use App\Http\Presenters\Product\ProductAsArrayPresenter;
use App\Http\Presenters\Product\ProductAsPaginationArrayPresenter;
use App\Http\Requests\Product\GetProductsByCategoryIdValidationRequest;

class ProductController extends ApiController
{
    public function getProductsByCategoryId(
        GetProductsByCategoryAction $getProductByCategoryAction,
        ProductAsPaginationArrayPresenter $productAsPaginationArrayPresenter,
        GetProductsByCategoryIdValidationRequest $request
    ): JsonResponse {
        $products = $getProductByCategoryAction
            ->execute(new GetProductsByCategoryRequest(
                (int) $request->input('categoryId'),
                $request->input('name'),
                $request->input('page'),
                $request->input('orderType'),
                $request->input('orderDirection'),
                $request->input('properties')
            ))
            ->getResponse();

        $presenter = $productAsPaginationArrayPresenter->presentCollection($products);

        return $this->successResponse($presenter);
    }

    public function getProductsForUser(
        GetProductsByUserAction $getProductsByUserAction,
        ProductAsPaginationArrayPresenter $productAsArrayPresenter,
        Request $request
    ): JsonResponse {
        $products = $getProductsByUserAction
            ->execute(new GetProductsByUserRequest(
                (int) $request->input('userId'),
                (int) $request->input('categoryId'),
                $request->input('orderType'),
                $request->input('orderDirection'),
            ))
            ->getResponse();

        $presenter = $productAsArrayPresenter->presentCollection($products);

        return $this->successResponse($presenter);
    }

    public function create(
        AddProductAction $addProductAction,
        ProductAsPaginationArrayPresenter $productAsPaginationArrayPresenter,
        ProductValidateRequest $request
    ): JsonResponse {
        $newProduct = $addProductAction
            ->execute(new AddProductRequest(
                $request->name,
                $request->description,
                $request->categoryId,
                $request->price,
                $request->active,
                $request->availability,
                $request->equipmentId,
                $request->level,
                $request->profession,
                $request->propertyId,
                $request->raceId,
                $request->rankId,
                $request->shortDescription,
                $request->subPropertyId,
                $request->typeId,
            ))
            ->getResponse();

        $presenter = $productAsPaginationArrayPresenter
            ->present($newProduct);

        return $this->successResponse($presenter);
    }

    public function edit(
        GetProductByIdAction $getProductByIdAction,
        ProductAsPaginationArrayPresenter $productAsPaginationArrayPresenter,
        string $productId
    ): JsonResponse {
        $product = $getProductByIdAction
            ->execute(new GetProductByIdRequest((int) $productId))
            ->getResponse();

        $presenter = $productAsPaginationArrayPresenter
            ->present($product);

        return $this->successResponse($presenter);
    }

    public function update(
        UpdateProductAction $updateProductAction,
        ProductAsPaginationArrayPresenter $productAsPaginationArrayPresenter,
        ProductValidateRequest $request,
        string $productId
    ): JsonResponse {
        $updatedProduct = $updateProductAction
            ->execute(new UpdateProductRequest(
                (int) $productId,
                $request->name,
                $request->description,
                $request->categoryId,
                $request->price,
                $request->active,
                $request->availability,
                $request->equipmentId,
                $request->level,
                $request->profession,
                $request->propertyId,
                $request->raceId,
                $request->rankId,
                $request->shortDescription,
                $request->subPropertyId,
                $request->typeId,
            ))
            ->getResponse();

        $presenter = $productAsPaginationArrayPresenter->present($updatedProduct);

        return $this->successResponse($presenter);
    }

    public function delete(
        DeleteProductAction $deleteProductAction,
        string $productId
    ): JsonResponse {
        $deleteProductAction
            ->execute(new DeleteProductRequest((int) $productId));

        return $this->successResponse(['msg' => 'OK']);
    }

    public function toggleActive(
        ToggleProductActiveAction $toggleProductActiveAction,
        ProductAsPaginationArrayPresenter $productAsPaginationArrayPresenter,
        string $productId
    ): JsonResponse {
        $patchedProduct = $toggleProductActiveAction
            ->execute(new GetProductByIdRequest((int) $productId))
            ->getResponse();

        $presenter = $productAsPaginationArrayPresenter->present($patchedProduct);

        return $this->successResponse($presenter);
    }
}
