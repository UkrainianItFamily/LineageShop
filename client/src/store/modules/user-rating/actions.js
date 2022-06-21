import * as actions from './types/actions';
import * as mutations from './types/mutations';
import UserRatingService from '@/services/user-rating-service/UserRatingService';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  [actions.GET_USER_RATINGS_BY_USER]: async (
    { commit, dispatch },
    userId = null
  ) => {
    try {
      const userRatings = await UserRatingService.getUserRating(userId);
      commit(mutations.SET_USER_RATINGS_BY_USER, userRatings);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
