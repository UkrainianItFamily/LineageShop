import * as mutations from './types/mutations';
import { orderMapper, ordersMapper } from './normalizer';

export default {
  [mutations.SET_ORDERS]: (state, orders) => {
    state.orders = ordersMapper(orders);
  },
  [mutations.SET_PURCHASES]: (state, purchases) => {
    state.purchases = ordersMapper(purchases);
  },
  [mutations.SET_SALES]: (state, sales) => {
    state.sales = ordersMapper(sales);
  },
  [mutations.UPDATE_ORDER]: (state, order) => {
    state.orders = {
      ...state.orders,
      [order.id]: orderMapper(order)
    };
  },
  [mutations.SET_ORDER]: (state, order) => {
    state.order = orderMapper(order);
  }
};
