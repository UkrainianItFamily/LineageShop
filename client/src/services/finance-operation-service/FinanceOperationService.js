import requestService from '@/services/request-service/ApiRequestService';

const financeOperationService = {
  async addFinanceOperation(data) {
    const response = await requestService.post('/finance-operations/', data);

    return response?.data?.data;
  },
  async changeFinanceOperationStatusToCancel(data) {
    const response = await requestService.put(
      `/finance-operations/${data.financeOperationId}`,
      data
    );

    return response?.data?.data;
  },
  async changeFinanceOperationStatus(data) {
    const response = await requestService.patch(
      '/finance-operations/change-finance-operation-status',
      data
    );

    return response?.data?.data;
  },
  async getFinanceOperationById(id) {
    const response = await requestService.get('/finance-operations/' + id);

    return response?.data?.data;
  },
  async getFinanceOperationsByType(type) {
    const response = await requestService.get(
      '/finance-operations?type=' + type
    );
    return response?.data?.data;
  },
  async getAllFinanceOperations(data) {
    const response = await requestService.get(
      '/administration/finance-operations/get-all',
      data
    );
    return response?.data?.data;
  }
};

export default financeOperationService;
