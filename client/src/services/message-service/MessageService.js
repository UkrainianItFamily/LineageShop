import requestService from '@/services/request-service/ApiRequestService';

const MessageService = {
  async addMessage(data) {
    await requestService.post('/messages', data);
  },

  async getMessagesByChatId(chatId) {
    const response = await requestService.get(
      '/messages/get-messages-by-chat-id/' + chatId
    );

    return response?.data?.data;
  }
};

export default MessageService;
