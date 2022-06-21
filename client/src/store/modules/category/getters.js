import * as getters from './types/getters';

export default {
  [getters.GET_CURRENT_CATEGORY]: state => state.currentCategory,
  [getters.GET_CATEGORIES]: state => state.categories,
  [getters.GET_CATEGORIES_WITH_PRODUCTS_FOR_USER]: state =>
    state.categoriesWithProducts
};
