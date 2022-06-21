import * as getters from './types/getters';

export default {
  [getters.GET_FINANCE_OPERATIONS]: state => (orderType, orderDirection) => {
    return Object.values(state.financeOperations).sort((a, b) => {
      if (orderType === 'created_at') {
        if (orderDirection === 'DESC') {
          return (
            new Date(a.createdAt).getTime() - new Date(b.createdAt).getTime()
          );
        }
        return (
          new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime()
        );
      } else {
        if (orderDirection === 'DESC') {
          return orderType
            ? a[orderType].value - b[orderType].value
            : a['id'] - b['id'];
        }
        return orderType
          ? b[orderType].value - a[orderType].value
          : b['id'] - a['id'];
      }
    });
  },
  [getters.GET_FINANCE_OPERATION]: state => state.financeOperation
};
