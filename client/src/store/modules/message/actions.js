import * as actions from './types/actions';
import * as mutations from './types/mutations';
import MessageService from '@/services/message-service/MessageService';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  [actions.ADD_MESSAGE]: async ({ dispatch }, data) => {
    try {
      await MessageService.addMessage(data);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_MESSAGES_BY_CHAT_ID]: async ({ commit, dispatch }, chatId) => {
    try {
      const messages = await MessageService.getMessagesByChatId(chatId);

      commit(mutations.SET_MESSAGES, messages);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
