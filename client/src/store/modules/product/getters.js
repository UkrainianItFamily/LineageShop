import * as getters from './types/getters';

export default {
  [getters.GET_PRODUCT]: state => state.product,
  [getters.GET_PRODUCTS]: state => state.products,
  [getters.GET_PRODUCTS]: state => (
    orderType,
    orderDirection,
    firstFilter,
    secondFilter,
    search,
    onlyOnline,
    betweenFilter
  ) => {
    let filterValue = firstFilter[0];
    let secondFilterValue = secondFilter[0];
    let products = Object.values(state.products).sort((a, b) => {
      if (orderDirection === 'DESC') {
        return orderType ? a[orderType] - b[orderType] : a['id'] - b['id'];
      }
      return orderType ? b[orderType] - a[orderType] : b['id'] - a['id'];
    });

    if (filterValue !== undefined && filterValue !== 'null') {
      let filterName = firstFilter[1];

      products = products.filter(
        product => product[filterName].id === filterValue
      );
    }
    if (secondFilterValue !== undefined && secondFilterValue !== 'null') {
      let secondFilterName = secondFilter[1];

      products = products.filter(
        product => product[secondFilterValue].id === secondFilterName
      );
    }
    if (search.length > 0) {
      search = search.toString().toLowerCase();
      products = products.filter(product => {
        if (product.description) {
          return product.description.toLowerCase().includes(search);
        } else {
          return product.name.toLowerCase().includes(search);
        }
      });
    }
    if (onlyOnline === true) {
      products = products.filter(product => product.user.online === 1);
    }
    if (Object.values(betweenFilter).length > 1) {
      let fieldName = betweenFilter.name;
      let minValue = betweenFilter.betweenMin ? betweenFilter.betweenMin : 0;
      let maxValue = betweenFilter.betweenMax
        ? betweenFilter.betweenMax
        : Infinity;
      products = products.filter(product => {
        if (product[fieldName] >= minValue && product[fieldName] <= maxValue) {
          return product;
        }
      });
    }

    return products;
  },
  [getters.GET_PRODUCTS_FOR_USER]: state => state.productsForUser
};
