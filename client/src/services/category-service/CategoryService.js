import requestService from '@/services/request-service/ApiRequestService';

const categoryService = {
  async getCategoryById(id) {
    const response = await requestService.get('/categories/' + id);

    return response?.data?.data;
  },

  async getCategories() {
    const response = await requestService.get('/categories/');

    return response?.data?.data;
  },

  async getCategoriesWithProductsForUser(userId) {
    const response = await requestService.get(
      '/categories/by-user-id/' + userId
    );

    return response?.data?.data;
  }
};

export default categoryService;
