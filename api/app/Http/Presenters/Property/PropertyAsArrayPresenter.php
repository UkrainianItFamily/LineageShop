<?php

namespace App\Http\Presenters\Property;

use App\Models\Property;
use App\Constant\PropertyConstant;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\PropertyDefaultValue\PropertyDefaultValueAsArrayPresenter;

class PropertyAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter;
    private SubPropertyAsArrayPresenter $subPropertyAsArrayPresenter;

    public function __construct(
        PropertyDefaultValueAsArrayPresenter $propertyDefaultValueAsArrayPresenter,
        SubPropertyAsArrayPresenter $subPropertyAsArrayPresenter)
    {
        $this->subPropertyAsArrayPresenter = $subPropertyAsArrayPresenter;
        $this->propertyDefaultValueAsArrayPresenter = $propertyDefaultValueAsArrayPresenter;
    }

    public function present(Property $property): array
    {
        (array) $arrayProperty = [
            'id' => $property->getId(),
            'name' => $property->getName(),
            'inputName' => $property->getInputName(),
            'type' => $property->getType(),
            'sortable' => $property->getSortable(),
            'displayInProductList' => $property->getDisplayInProductList(),
            'propertyDefaultValues' => ($property->type === PropertyConstant::DEFAULT_VALUE)
                ? $this->propertyDefaultValueAsArrayPresenter->presentCollection($property->propertyDefaultValues)
                : null,
            'subProperties' => count($property->children) > 0
                ? $this->subPropertyAsArrayPresenter->presentCollection($property->children)
                : null,
        ];

        return $arrayProperty;
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
