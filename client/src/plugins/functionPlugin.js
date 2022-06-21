import _ from 'lodash';

let Functions = {};

Functions.install = function(Vue) {
  Vue.getCurrentCategoryId = route => {
    const DEFAULT_CURRENT_CATEGORY =
      process.env.VUE_APP_DEFAULT_CURRENT_CATEGORY;

    return Number(_.get(route, 'params.categoryId', DEFAULT_CURRENT_CATEGORY));
  };

  Vue.getCountAllUserRatings = userRatings => {
    return _.values(userRatings).length;
  };

  Vue.getUserRatingAverage = (userRatings, getCountAllUserRatings) => {
    let userRatingAverage = _.floor(
      _.sumBy(_.values(userRatings), 'rating') / getCountAllUserRatings,
      1
    );

    return userRatingAverage ? userRatingAverage : 0;
  };

  Vue.getUserRatingInPercentage = (userRatings, getCountAllUserRatings) => {
    let userRatingGroupByRating = {};
    let userRatingsCount = _.countBy(_.values(userRatings), 'rating');
    for (let i = 1; i <= Vue.prototype.$getConst('RATING').MAX; i++) {
      userRatingGroupByRating[i] = userRatingsCount[i]
        ? (userRatingsCount[i] / getCountAllUserRatings) * 100
        : 0;
    }
    return userRatingGroupByRating;
  };
};

export default Functions;
