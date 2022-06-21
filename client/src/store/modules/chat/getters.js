import * as getters from './types/getters';

export default {
  [getters.GET_CHATS]: state => state.chats,
  [getters.GET_CHAT]: state => state.chat
};
