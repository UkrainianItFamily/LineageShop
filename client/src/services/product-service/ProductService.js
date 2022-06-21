import requestService from '@/services/request-service/ApiRequestService';

const productService = {
  async getProductById(id) {
    const response = await requestService.get('/products/' + id);

    return response?.data?.data;
  },
  async getProducts(data) {
    const response = await requestService.get('/products/', data);

    return response?.data?.data;
  },
  async getProductsForUser(data) {
    const response = await requestService.get(
      '/products/get-products-for-user',
      data
    );

    return response?.data?.data;
  },
  async addProduct(data) {
    const response = await requestService.post('/products', data);

    return response?.data?.data;
  },
  async updateProduct(id, data) {
    const response = await requestService.put('/products/' + id, data);

    return response?.data?.data;
  },
  async deleteProduct(id) {
    const response = await requestService.delete('/products/' + id);

    return response?.data?.data;
  }
};

export default productService;
