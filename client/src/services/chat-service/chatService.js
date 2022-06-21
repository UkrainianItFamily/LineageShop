import requestService from '@/services/request-service/ApiRequestService';

const chatService = {
  async getChatsByCurrentUser() {
    const response = await requestService.get(
      '/chats/get-chats-by-current-user'
    );

    return response?.data?.data;
  },

  async addChat(data) {
    const response = await requestService.post('/chats', data);

    return response?.data?.data;
  },

  async getChat(chatId) {
    const response = await requestService.get('/chats/' + chatId);

    return response?.data?.data;
  },

  async getChatByUserId(userId) {
    const response = await requestService.get(
      '/chats/get-chat-by-user-id/' + userId
    );

    return response?.data?.data;
  }
};

export default chatService;
