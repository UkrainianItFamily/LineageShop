import Vue from 'vue';
import { userMapper } from '@/store/modules/user/normalizer';
import { productMapper } from '../product/normalizer';
import { walletTypeMapper } from '../wallet-type/normalizer';

export const ordersMapper = function(orders) {
  let result = [];

  result = {
    ...result,
    ...orders.reduce(
      (prev, order) => ({
        ...prev,
        [order.id]: orderMapper(order)
      }),
      {}
    )
  };

  return result;
};

export const orderMapper = order => ({
  id: order.id,
  date: order.dateOpen,
  product: productMapper(order.product),
  walletType: walletTypeMapper(order.walletType),
  description: order.product.description
    ? order.product.description
    : order.product.shortDescription,
  status: presentStatus(order.status),
  nickname: order.nickname,
  quantity: order.quantity,
  orderPrice: order.orderPrice,
  customer: userMapper(order.userCustomer),
  seller: userMapper(order.userSeller),
  price: order.orderPrice
});

export const orderForUserRatingMapper = order => ({
  id: order.id,
  productPrice: order.productPrice,
  shipType: order.shipType,
  status: presentStatus(order.status),
  date: order.dateOpen
});

function presentStatus(status) {
  switch (status) {
    case Vue.prototype.$getConst('ORDER_STATUS').CREATED:
      return {
        value: Vue.prototype.$getConst('ORDER_STATUS').CREATED,
        title: 'Создан',
        variant: 'secondary'
      };
    case Vue.prototype.$getConst('ORDER_STATUS').CLOSED:
      return {
        value: Vue.prototype.$getConst('ORDER_STATUS').CLOSED,
        title: 'Закрыт',
        variant: 'success'
      };
    case Vue.prototype.$getConst('ORDER_STATUS').CONFIRMED:
      return {
        value: Vue.prototype.$getConst('ORDER_STATUS').CONFIRMED,
        title: 'Подтвержден',
        variant: 'secondary'
      };

    case Vue.prototype.$getConst('ORDER_STATUS').CANCELED:
      return {
        value: Vue.prototype.$getConst('ORDER_STATUS').CANCELED,
        title: 'Отменён',
        variant: 'danger'
      };
    default:
      return null;
  }
}
