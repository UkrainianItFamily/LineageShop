import * as getters from './types/getters';

export default {
  [getters.GET_MESSAGES]: state => state.messages
};
