import * as mutations from './types/mutations';

import {
  supportRequestMapper,
  supportRequestMessagesMapper,
  supportRequestsMapper,
  supportRequestsMessageMapper
} from './normalizer';

export default {
  [mutations.SET_SUPPORT_REQUESTS]: (state, data) => {
    state.supportRequests = supportRequestsMapper(data);
  },
  [mutations.SET_SUPPORT_REQUEST_MESSAGES]: (state, data) => {
    state.supportRequestMessages = supportRequestMessagesMapper(data);
  },
  [mutations.SET_SUPPORT_REQUEST]: (state, data) => {
    state.supportRequest = supportRequestMapper(data);
  },
  [mutations.ADD_SUPPORT_REQUEST_MESSAGE]: (state, message) => {
    state.supportRequestMessages = {
      ...state.supportRequestMessages,
      [message.id]: supportRequestsMessageMapper(message)
    };
  },
  [mutations.UPDATE_SUPPORT_REQUEST]: (state, supportRequest) => {
    state.supportRequest = supportRequestMapper(supportRequest);
  }
};
