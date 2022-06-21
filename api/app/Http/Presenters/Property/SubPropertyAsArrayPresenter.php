<?php

namespace App\Http\Presenters\Property;

use App\Constant\PropertyConstant;
use App\Http\Presenters\PropertyDefaultValue\PropertyDefaultValueAsArrayPresenter;
use App\Models\Property;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class SubPropertyAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter;

    public function __construct(
        PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter
    )
    {
        $this->propertyDefaultValueAsArrayPresenter = $propertyDefaultValueAsArrayPresenter;
    }

    public function present(Property $property): array
    {
        (array) $arraySubProperties = [
            'id' => $property->getId(),
            'name' => $property->getName(),
            'inputName' => $property->getInputName(),
            'type' => $property->getType(),
            'sortable' => $property->getSortable(),
            'displayInProductList' => $property->getDisplayInProductList(),
            'propertyDefaultValues' => ($property->type === PropertyConstant::DEFAULT_VALUE)
                ? $this->propertyDefaultValueAsArrayPresenter->presentCollection($property->propertyDefaultValues)
                : null,
            'parentValueId' => $property->getParentDefaultValue()
        ];

        return $arraySubProperties;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Property $property) {
                    return $this->present($property);
                }
            )
            ->all();
    }
}
