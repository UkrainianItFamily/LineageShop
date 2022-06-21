import * as actions from './types/actions';
import SupportService from '@/services/support-service/SupportService';
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as mutations from './types/mutations';

export default {
  [actions.SEND_SUPPORT_REQUEST]: async ({ commit, dispatch }, data) => {
    try {
      await SupportService.sendSupportRequest(data);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
      return false;
    }
  },
  [actions.SEND_SUPPORT_REQUEST_MESSAGE]: async (
    { commit, dispatch },
    data
  ) => {
    try {
      const newMessage = await SupportService.sendSupportRequestMessage(data);
      commit(mutations.ADD_SUPPORT_REQUEST_MESSAGE, newMessage);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_SUPPORT_REQUEST]: async (
    { commit, dispatch },
    filtersValues
  ) => {
    try {
      const data = await SupportService.getSupportRequest(filtersValues);
      commit(mutations.SET_SUPPORT_REQUEST, data);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_SUPPORT_REQUEST_MESSAGES]: async ({ commit, dispatch }, id) => {
    try {
      const data = await SupportService.getAllSupportRequestMessages(id);
      commit(mutations.SET_SUPPORT_REQUEST_MESSAGES, data);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SET_SUPPORT_REQUEST_STATUS]: async ({ commit, dispatch }, data) => {
    try {
      const updatedSupportStatusRequest = {
        requestId: data.requestId,
        requestStatusId: data.requestStatusId
      };
      const supportRequest = await SupportService.updateSupportStatusRequest(
        updatedSupportStatusRequest
      );
      commit(mutations.UPDATE_SUPPORT_REQUEST, supportRequest);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_SUPPORT_REQUESTS_BY_CRITERIA]: async (
    { commit, dispatch },
    filtersValues
  ) => {
    try {
      const data = await SupportService.getSupportRequestsByCriteria(
        filtersValues
      );
      commit(mutations.SET_SUPPORT_REQUESTS, data);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
