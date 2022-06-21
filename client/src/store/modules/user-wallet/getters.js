import * as getters from './types/getters';

export default {
  [getters.GET_USER_WALLETS_BY_WALLET_TYPE_ID]: state =>
    state.userWalletsByWalletTypeId,
  [getters.GET_USER_WALLETS]: state => state.userWallets
};
