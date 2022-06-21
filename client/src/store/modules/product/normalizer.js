import { userMapper } from '@/store/modules/user/normalizer';
import { propertiesValueMapper } from '@/store/modules/property-value/normalizer';

export const productsMapper = function(products) {
  let result = [];

  result = {
    ...result,
    ...products.reduce(
      (prev, product) => ({
        ...prev,
        [product.id]: productMapper(product)
      }),
      {}
    )
  };

  return result;
};

export const productMapper = product => ({
  id: product.id,
  active: Boolean(product.active),
  name: product.name,
  categoryId: product.categoryId,
  description: product.description,
  price: product.price,
  availability: product.availability,
  user: product.user ? userMapper(product.user) : null,
  propertiesValue: product.propertiesValue
    ? propertiesValueMapper(product.propertiesValue)
    : null,
  subProperty: product.subProperty ? product.subProperty : null,
  race: product.race ? propertyMapper(product.race) : null,
  equipment: product.equipment ? propertyMapper(product.equipment) : null,
  level: product.level ? product.level : null,
  profession: product.profession ? product.profession : null,
  rank: product.rank ? propertyMapper(product.rank) : null,
  property: product.property ? product.property : null,
  type: product.type ? propertyMapper(product.type) : null,
  shortDescription: product.shortDescription ? product.shortDescription : null
});

export const propertyMapper = property => ({
  id: property.id ? property.id : null,
  value: property.value ? property.value : null
});
