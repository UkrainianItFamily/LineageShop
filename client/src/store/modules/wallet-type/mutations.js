import * as mutations from './types/mutations';
import { walletTypesMapper } from './normalizer';

export default {
  [mutations.SET_WALLET_TYPES]: (state, walletTypes) => {
    state.walletTypes = walletTypesMapper(walletTypes);
  }
};
