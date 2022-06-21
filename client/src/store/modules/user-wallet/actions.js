import * as actions from './types/actions';
import * as mutations from './types/mutations';
import UserWalletService from '@/services/user-wallet-service/UserWalletService';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  [actions.GET_USER_WALLETS_BY_WALLET_TYPE_ID]: async (
    { commit, dispatch },
    walletTypeId
  ) => {
    try {
      const userWallets = await UserWalletService.getUserWalletsByWalletTypeId(
        walletTypeId
      );
      commit(mutations.SET_USER_WALLETS_BY_WALLET_TYPE_ID, userWallets);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_USER_WALLETS]: async ({ commit, dispatch }) => {
    try {
      const userWallets = await UserWalletService.getUserWalletsForUser();
      commit(mutations.SET_USER_WALLETS, userWallets);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.ADD_USER_WALLET]: async ({ commit, dispatch }, data) => {
    try {
      const userWallet = await UserWalletService.addUserWallet(data);
      commit(mutations.ADD_USER_WALLET, userWallet);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.UPDATE_USER_WALLET]: async ({ commit, dispatch }, data) => {
    try {
      const userWallet = await UserWalletService.updateUserWallet(data);
      commit(mutations.UPDATE_USER_WALLET, userWallet);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.DELETE_USER_WALLET]: async ({ commit, dispatch }, userWalletId) => {
    try {
      await UserWalletService.deleteUserWallet(userWalletId);
      commit(mutations.DELETE_USER_WALLET, userWalletId);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
