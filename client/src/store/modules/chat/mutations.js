import * as mutations from './types/mutations';
import { chatsMapper, chatMapper } from './normalizer';

export default {
  [mutations.SET_CHATS]: (state, chats) => {
    state.chats = chatsMapper(chats);
  },

  [mutations.ADD_CHAT]: (state, chat) => {
    state.chats = {
      ...state.chats,
      [chat.id]: chatMapper(chat)
    };
    state.chat = chatMapper(chat);
  },

  [mutations.SET_CHAT]: (state, chat) => {
    state.chat = chatMapper(chat);
  }
};
