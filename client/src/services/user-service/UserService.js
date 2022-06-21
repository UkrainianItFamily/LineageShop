import requestService from '@/services/request-service/ApiRequestService';

const userService = {
  async getAllUsers() {
    const response = await requestService.get('/administration/users');

    return response?.data?.data;
  },
  async getUserById(userId) {
    const response = await requestService.get('/users/' + userId);

    return response?.data?.data;
  },
  async changePassword(data) {
    const response = await requestService.patch(
      '/users/change-password/',
      data
    );

    return response?.data?.data;
  },
  async bindEmail(email) {
    const response = await requestService.post('/users/bind-email', email);

    return response?.data?.data;
  },
  async changeUserData(data) {
    const response = await requestService.patch(
      '/administration/users/change-user-data',
      data
    );

    return response?.data?.data;
  },
  async adminResetUserPassword(data) {
    const response = await requestService.patch(
      '/administration/users/admin-reset-user-password',
      data
    );

    return response?.data?.data;
  }
};

export default userService;
