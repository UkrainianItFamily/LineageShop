import { userMapper } from '../user/normalizer';
import { orderForUserRatingMapper } from '../order/normalizer';

export const userRatingsMapper = function(userRatings) {
  let result = [];
  result = {
    ...result,
    ...userRatings.reduce(
      (prev, userRating) => ({
        ...prev,
        [userRating.id]: userRatingMapper(userRating)
      }),
      {}
    )
  };

  return result;
};

export const userRatingMapper = userRating => ({
  id: userRating.id,
  userId: userRating.userId,
  userCustomer: userMapper(userRating.userCustomer),
  rating: userRating.rating,
  text: userRating.text,
  order: orderForUserRatingMapper(userRating.order),
  createdAt: userRating.createdAt
});
