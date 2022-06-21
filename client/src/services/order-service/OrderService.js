import requestService from '@/services/request-service/ApiRequestService';

const orderService = {
  async getAllOrders(data) {
    const response = await requestService.get('/administration/orders', data);

    return response?.data?.data;
  },
  async getPurchasesForCurrentUser(data) {
    const response = await requestService.get('/orders/purchases', data);

    return response?.data?.data;
  },
  async getSalesForCurrentUser(data) {
    const response = await requestService.get('/orders/sales', data);

    return response?.data?.data;
  },

  async changeOrderStatus(data) {
    const response = await requestService.patch(
      '/administration/orders/change-order-status',
      data
    );

    return response?.data?.data;
  },

  async addOrder(data) {
    const response = await requestService.post('/orders', data);

    return response?.data?.data;
  },
  async getOrder(orderId) {
    const response = await requestService.get('/orders/' + orderId);

    return response?.data?.data;
  },
  async confirmOrder(data) {
    const response = await requestService.patch('/orders/confirm-order', {
      orderId: data.orderId,
      orderPrice: data.orderPrice
    });

    return response?.data?.data;
  }
};

export default orderService;
