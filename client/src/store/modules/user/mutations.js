import * as mutations from './types/mutations';
import { userMapper, usersMapper } from './normalizer';

export default {
  [mutations.SET_USERS]: (state, users) => {
    state.users = usersMapper(users);
  },
  [mutations.SET_USER]: (state, user) => {
    state.user = userMapper(user);
  }
};
