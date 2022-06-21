import * as getters from './types/getters';

export default {
  [getters.GET_USER_RATINGS_BY_USER]: state => state.userRatingByUserId
};
