<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Category\CategoryIdNotNumberException;
use App\Repositories\Category\CategoryRepositoryInterface;

final class GetCategoryByIdAction
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(GetCategoryByIdRequest $request): GetCategoryByIdResponse
    {
        if (!is_numeric($request->getId())) {
            throw new CategoryIdNotNumberException();
        }

        $category = $this->categoryRepository->getById($request->getId());

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        return new GetCategoryByIdResponse($category);
    }
}
