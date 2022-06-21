import requestService from '@/services/request-service/ApiRequestService';

const propertyService = {
  async getCurrentProperties(categoryId) {
    const response = await requestService.get('/properties/', { categoryId });

    return response?.data?.data;
  }
};

export default propertyService;
