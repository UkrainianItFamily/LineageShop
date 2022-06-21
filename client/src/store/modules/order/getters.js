import * as types from './types/getters';

export default {
  [types.GET_ORDERS]: state => state.orders,
  [types.GET_PURCHASES]: state => state.purchases,
  [types.GET_SALES]: state => state.sales,
  [types.GET_ORDER]: state => state.order
};
