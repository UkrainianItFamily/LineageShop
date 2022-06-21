import * as actions from './types/actions';
import * as mutations from './types/mutations';
import * as notificationActions from '@/store/modules/notification/types/actions';
import AuthService from '@/services/auth/AuthService';

export default {
  [actions.REGISTER_USER]: async ({ dispatch }, registerData) => {
    try {
      await AuthService.registerUser(registerData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.VERIFIED_EMAIL]: async ({ dispatch }, verifiedEmailData) => {
    try {
      await AuthService.verifiedEmail(verifiedEmailData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SIGN_IN]: async ({ dispatch }, loginData) => {
    try {
      await AuthService.signIn(loginData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.FETCH_LOGGED_USER]: async ({ commit, dispatch }) => {
    try {
      const fetchUserResponse = await AuthService.fetchLoggedUser();
      commit(mutations.SET_LOGGED_USER, fetchUserResponse);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SIGN_OUT]: async ({ commit, dispatch }) => {
    try {
      await AuthService.signOut();
      commit(mutations.USER_LOGOUT);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },

  [actions.FORGOT_PASSWORD]: async ({ dispatch }, forgotPasswordData) => {
    try {
      await AuthService.forgotPassword(forgotPasswordData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },

  [actions.RESET_PASSWORD]: async ({ dispatch }, resetPasswordData) => {
    try {
      await AuthService.resetPassword(resetPasswordData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.CHANGE_EMAIL]: async ({ commit, dispatch }, data) => {
    try {
      const user = await AuthService.changeEmail(data);
      commit(mutations.SET_LOGGED_USER, user);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.TOGGLE_CURRENT_USER_EMAIL_NOTIFICATION]: async ({
    commit,
    dispatch
  }) => {
    try {
      const user = await AuthService.toggleCurrentUserEmailNotification();
      commit(mutations.SET_LOGGED_USER, user);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SIGN_IN_BY_PROVIDER]: async ({ dispatch }, provider) => {
    try {
      window.location.href = await AuthService.signInByProvider(provider);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.PROVIDER_CALLBACK]: async ({ dispatch }, loginData) => {
    try {
      await AuthService.signInByProviderCallback(loginData.provider, loginData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
