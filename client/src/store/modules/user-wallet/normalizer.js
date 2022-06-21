import { walletTypeMapper } from '@/store/modules/wallet-type/normalizer';

export const userWalletsMapper = function(userWallets) {
  let result = [];

  result = {
    ...result,
    ...userWallets.reduce(
      (prev, userWallet) => ({
        ...prev,
        [userWallet.id]: userWalletMapper(userWallet)
      }),
      {}
    )
  };

  return result;
};

export const userWalletMapper = userWallet => ({
  id: userWallet.id,
  info: userWallet.info,
  walletType: walletTypeMapper(userWallet.type)
});
