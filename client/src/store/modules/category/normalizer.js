import { productsMapper } from '../product/normalizer';

export const categoriesMapper = function(categories) {
  let result = [];

  result = {
    ...result,
    ...categories.reduce(
      (prev, category) => ({
        ...prev,
        [category.id]: categoryMapper(category)
      }),
      {}
    )
  };

  return result;
};

export const categoryMapper = category => ({
  id: category.id,
  name: category.name,
  slug: category.slug,
  productsCount: category.productsCount,
  sellButtonName: category.sellButtonName,
  hasNicknameInOrder: category.hasNicknameInOrder,
  hasAmountCurrencyInOrder: category.hasAmountCurrencyInOrder,
  hasAvailability: category.hasAvailability,
  userProducts: category.userProducts
    ? productsMapper(category.userProducts)
    : null
});
