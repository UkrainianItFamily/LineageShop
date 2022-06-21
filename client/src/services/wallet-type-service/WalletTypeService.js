import requestService from '@/services/request-service/ApiRequestService';

const walletTypeService = {
  async getWalletTypes() {
    const response = await requestService.get('/wallet-types');

    return response?.data?.data;
  }
};

export default walletTypeService;
