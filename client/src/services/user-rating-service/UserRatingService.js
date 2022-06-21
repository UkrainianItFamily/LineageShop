import requestService from '@/services/request-service/ApiRequestService';

const userRatingService = {
  async getUserRating(userId) {
    const response = await requestService.get('/user-ratings/' + userId);

    return response?.data?.data;
  }
};

export default userRatingService;
