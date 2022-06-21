<?php

namespace App\Http\Presenters\PropertyValues;

use App\Models\PropertyValue;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\PropertyDefaultValue\PropertyDefaultValueAsArrayPresenter;

class PropertyValueAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter;

    public function __construct(
        PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter
    ) {
        $this->propertyDefaultValueAsArrayPresenter = $propertyDefaultValueAsArrayPresenter;
    }

    public function present(PropertyValue $propertyValue): array
    {
        (array) $arrayPropertyValue = [
            'id' => $propertyValue->getId(),
            'propertyId' => $propertyValue->getPropertyId(),
            'name' => $propertyValue->property->name,
            'value' => $propertyValue->getValue() ? $propertyValue->getValue() : null,
            'valueId' => $propertyValue->propertyDefaultValue ?
                $this->propertyDefaultValueAsArrayPresenter
                ->present($propertyValue->propertyDefaultValue)
                : null,
        ];

        return $arrayPropertyValue;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (PropertyValue $propertyValue) {
                    return $this->present($propertyValue);
                }
            )
            ->all();
    }
}
