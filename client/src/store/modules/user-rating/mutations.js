import * as mutations from './types/mutations';
import { userRatingsMapper } from './normalizer';

export default {
  [mutations.SET_USER_RATINGS_BY_USER]: (state, userRatings) => {
    state.userRatingByUserId = userRatingsMapper(userRatings);
  }
};
