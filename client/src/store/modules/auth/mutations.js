import * as mutations from './types/mutations';
import { userMapper } from '../user/normalizer';

export default {
  [mutations.USER_LOGOUT]: state => {
    state.user = null;
  },
  [mutations.SET_LOGGED_USER]: (state, userData) => {
    state.user = userMapper(userData);
  }
};
