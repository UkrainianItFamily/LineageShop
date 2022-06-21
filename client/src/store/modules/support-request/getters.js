import * as getters from './types/getters';

export default {
  [getters.GET_SUPPORT_REQUESTS]: state => (orderType, orderDirection) => {
    return Object.values(state.supportRequests).sort((a, b) => {
      if (orderType === 'status') {
        if (orderDirection === 'DESC') {
          return a.status.id - b.status.id;
        } else {
          return b.status.id - a.status.id;
        }
      } else {
        if (orderDirection === 'DESC') {
          return orderType
            ? new Date(a[orderType]).getTime() -
                new Date(b[orderType]).getTime()
            : a['id'] - b['id'];
        }
        return orderType
          ? new Date(b[orderType]).getTime() - new Date(a[orderType]).getTime()
          : b['id'] - a['id'];
      }
    });
  },
  [getters.GET_SUPPORT_REQUEST]: state => state.supportRequest,
  [getters.GET_SUPPORT_REQUEST_MESSAGES]: state => state.supportRequestMessages
};
