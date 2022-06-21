<?php

declare(strict_types=1);

namespace App\Actions\PropertyValue;

use App\Models\PropertyValue;
use App\Repositories\PropertyValue\PropertyValueRepository;

final class ChangePropertyValuesAction
{
    private PropertyValueRepository $propertyValueRepository;

    public function __construct(PropertyValueRepository $propertyValueRepository)
    {
        $this->propertyValueRepository = $propertyValueRepository;
    }

    public function execute(ChangePropertyValuesRequest $request): void
    {
        if ($request->getProperties()) {
            foreach ($request->getProperties() as $property) {
                $newPropertyValue = new PropertyValue();
                $newPropertyValue->product_id = $request->getProductId();
                $newPropertyValue->property_id = $property['id'];
                $newPropertyValue->value = $property['value'];
                $newPropertyValue->value_id = $property['value_id'];

                $this->propertyValueRepository->save($newPropertyValue);
            }
        }
    }
}
