<?php

namespace App\Http\Presenters\PropertyDefaultValue;

use Illuminate\Support\Collection;
use App\Models\PropertyDefaultValue;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class PropertyDefaultValueAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    public function present(PropertyDefaultValue $propertyDefaultValue): array
    {
        (array) $arrayPropertyDefaultValue = [
            'id' => $propertyDefaultValue->getId(),
            'propertyId' => $propertyDefaultValue->getPropertyId(),
            'value' => $propertyDefaultValue->getValue(),
        ];

        return $arrayPropertyDefaultValue;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (PropertyDefaultValue $propertyDefaultValue) {
                    return $this->present($propertyDefaultValue);
                }
            )
            ->all();
    }
}
