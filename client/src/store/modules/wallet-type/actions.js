import * as actions from './types/actions';
import * as mutations from './types/mutations';
import WalletTypeService from '@/services/wallet-type-service/WalletTypeService';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  [actions.GET_WALLET_TYPES]: async ({ commit, dispatch }) => {
    try {
      const walletTypes = await WalletTypeService.getWalletTypes();
      commit(mutations.SET_WALLET_TYPES, walletTypes);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
