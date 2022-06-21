import * as mutations from './types/mutations';
import { messagesMapper } from './normalizer';

export default {
  [mutations.SET_MESSAGES]: (state, messages) => {
    state.messages = messagesMapper(messages);
  }
};
