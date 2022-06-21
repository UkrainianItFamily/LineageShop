import * as mutations from './types/mutations';
import { userWalletMapper, userWalletsMapper } from './normalizer';

export default {
  [mutations.SET_USER_WALLETS_BY_WALLET_TYPE_ID]: (state, userWallet) => {
    state.userWalletsByWalletTypeId = userWalletsMapper(userWallet);
  },
  [mutations.SET_USER_WALLETS]: (state, userWallet) => {
    state.userWallets = userWalletsMapper(userWallet);
  },
  [mutations.ADD_USER_WALLET]: (state, userWallet) => {
    state.userWallets = {
      ...state.userWallets,
      [userWallet.id]: userWalletMapper(userWallet)
    };
  },
  [mutations.UPDATE_USER_WALLET]: (state, userWallet) => {
    state.userWallets = {
      ...state.userWallets,
      [userWallet.id]: userWalletMapper(userWallet)
    };
  },
  [mutations.DELETE_USER_WALLET]: (state, userWalletId) => {
    const userWallets = { ...state.userWallets };
    delete userWallets[userWalletId];
    state.userWallets = userWallets;
  }
};
