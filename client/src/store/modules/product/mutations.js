import * as mutations from './types/mutations';
import { productsMapper, productMapper } from './normalizer';

export default {
  [mutations.SET_PRODUCT]: (state, product) => {
    state.product = productMapper(product);
  },
  [mutations.SET_PRODUCTS]: (state, products) => {
    state.products = productsMapper(products);
  },
  [mutations.SET_PRODUCTS_FOR_USER]: (state, products) => {
    state.productsForUser = productsMapper(products);
  },
  [mutations.ADD_PRODUCT]: (state, product) => {
    state.productsForUser = {
      ...state.productsForUser,
      [product.id]: productMapper(product)
    };
  },
  [mutations.UPDATE_PRODUCT]: (state, product) => {
    state.productsForUser = {
      ...state.productsForUser,
      [product.id]: productMapper(product)
    };
  },
  [mutations.DELETE_PRODUCT]: (state, productId) => {
    const productsForUser = { ...state.productsForUser };
    delete productsForUser[productId];
    state.productsForUser = productsForUser;
  }
};
