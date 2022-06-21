export const propertiesValueMapper = function(propertiesValue) {
  let result = [];

  result = {
    ...result,
    ...propertiesValue.reduce(
      (prev, propertyValue) => ({
        ...prev,
        [propertyValue.id]: propertyValueMapper(propertyValue)
      }),
      {}
    )
  };

  return result;
};

export const propertyValueMapper = propertyValue => ({
  id: propertyValue.id,
  name: propertyValue.name,
  propertyId: propertyValue.propertyId,
  value: propertyValue.value,
  valueId: propertyValue.valueId
});
