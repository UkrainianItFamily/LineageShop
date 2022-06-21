import requestService from '@/services/request-service/ApiRequestService';

const supportService = {
  async sendSupportRequest(data) {
    const response = await requestService.post('/support-request', data);

    return response?.data?.data?.[0];
  },
  async getSupportRequest(SupportRequestId) {
    const response = await requestService.get(
      '/support-request/' + SupportRequestId
    );

    return response?.data;
  },
  async sendSupportRequestMessage(data) {
    const response = await requestService.post(
      '/send-support-request-message/',
      data
    );

    return response?.data?.data;
  },
  async getAllSupportRequestMessages(SupportRequestId) {
    const response = await requestService.get(
      '/support-request-messages/' + SupportRequestId
    );

    return response?.data?.data;
  },

  async updateSupportStatusRequest(data) {
    const response = await requestService.patch(
      '/support-request/status-update/',
      data
    );

    return response?.data;
  },

  async getSupportRequestsByCriteria(data) {
    const response = await requestService.post(
      '/administration/support-requests/',
      data
    );
    return response?.data;
  },

  async getSupportRequestsByCriteriaForUser(data) {
    const response = await requestService.post('/support-requests/', data);
    return response?.data;
  }
};

export default supportService;
