import * as getters from './types/getters';

export default {
  [getters.GET_USERS]: state => state.users,
  [getters.GET_USER]: state => state.user
};
