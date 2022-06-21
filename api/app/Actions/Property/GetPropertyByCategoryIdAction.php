<?php

declare(strict_types=1);

namespace App\Actions\Property;

use App\Repositories\Property\PropertyRepository;

final class GetPropertyByCategoryIdAction
{
    private PropertyRepository $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function execute(GetPropertyByCategoryIdRequest $request): GetPropertyByCategoryIdResponse
    {
        $propertyList = $this->propertyRepository->getPropertyByCategoryId($request->getCategoryId());

        return new GetPropertyByCategoryIdResponse($propertyList);
    }
}
