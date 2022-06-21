import requestService from '@/services/request-service/ApiRequestService';

const userWalletService = {
  async getUserWalletsByWalletTypeId(walletTypeId) {
    const response = await requestService.get(
      '/user-wallets/by-wallet-type-id/' + walletTypeId
    );

    return response?.data?.data;
  },
  async getUserWalletsForUser() {
    const response = await requestService.get('/user-wallets/');

    return response?.data?.data;
  },
  async addUserWallet(data) {
    const response = await requestService.post('/user-wallets/', data);

    return response?.data?.data;
  },
  async updateUserWallet(data) {
    const response = await requestService.put('/user-wallets/', data);

    return response?.data?.data;
  },
  async deleteUserWallet(userWalletId) {
    await requestService.delete('/user-wallets/' + userWalletId);
  }
};

export default userWalletService;
