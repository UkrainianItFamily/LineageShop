export const propertiesMapper = function(properties) {
  let result = [];

  result = {
    ...result,
    ...properties.reduce(
      (prev, property) => ({
        ...prev,
        [property.id]: propertyMapper(property)
      }),
      {}
    )
  };

  return result;
};

export const propertyMapper = property => ({
  id: property.id,
  name: property.name,
  inputName: property.inputName,
  type: property.type,
  sortable: property.sortable,
  displayInProductList: property.displayInProductList,
  propertyDefaultValues:
    property.propertyDefaultValues !== null
      ? propertyDefaultValuesMapper(property.propertyDefaultValues)
      : null,
  subProperties:
    property.subProperties !== null
      ? subPropertiesMapper(property.subProperties)
      : null
});

export const propertyDefaultValuesMapper = function(propertyDefaultValues) {
  let result = [];

  result = {
    ...result,
    ...propertyDefaultValues.reduce(
      (prev, propertyDefaultValue) => ({
        ...prev,
        [propertyDefaultValue.id]: propertyDefaultValueMapper(
          propertyDefaultValue
        )
      }),
      {}
    )
  };

  return result;
};

export const propertyDefaultValueMapper = propertyDefaultValue => ({
  name: propertyDefaultValue.value,
  type: 0,
  value: propertyDefaultValue.id,
  text: propertyDefaultValue.value,
  property_id: propertyDefaultValue.property_id
});

export const subPropertiesMapper = function(properties) {
  let result = [];

  result = {
    ...result,
    ...properties.reduce(
      (prev, property) => ({
        ...prev,
        [property.id]: subPropertyMapper(property)
      }),
      {}
    )
  };

  return result;
};

export const subPropertyMapper = property => ({
  id: property.id,
  name: property.name,
  inputName: property.inputName,
  type: property.type,
  sortable: property.sortable,
  displayInProductList: property.displayInProductList,
  propertyDefaultValues:
    property.propertyDefaultValues !== null
      ? propertyDefaultValuesMapper(property.propertyDefaultValues)
      : null,
  parentDefaultValueId: property.parentValueId
});
