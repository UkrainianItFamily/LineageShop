export const walletTypesMapper = function(walletTypes) {
  let result = [];

  result = {
    ...result,
    ...walletTypes.reduce(
      (prev, walletType) => ({
        ...prev,
        [walletType.id]: walletTypeMapper(walletType)
      }),
      {}
    )
  };

  return result;
};

export const walletTypeMapper = walletType => ({
  id: walletType.id,
  name: walletType.name,
  walletSymbol: walletType.walletSymbol
});
