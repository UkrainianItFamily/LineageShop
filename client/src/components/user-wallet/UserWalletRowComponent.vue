<template>
  <BTr>
    <BTh> {{ userWallet.walletType.name }} </BTh>
    <BTh> {{ userWallet.info }} </BTh>
    <BTh>
      <BButton
        v-b-modal="`delete-user-wallet-${userWallet.id}`"
        size="sm"
        variant="danger"
        class="shadow-none text-uppercase font-weight-bold"
        >удалить</BButton
      >
      <ModalUpdateUserWalletComponent
        :userWallet="userWallet"
        :optionsUserWallets="optionsUserWallets"
      >
      </ModalUpdateUserWalletComponent
    ></BTh>
    <BTh>
      <BButton
        v-b-modal="`update-user-wallet-${userWallet.id}`"
        size="sm"
        variant="primary"
        class="shadow-none text-uppercase font-weight-bold"
        >изменить</BButton
      >
      <ModalDeleteUserWalletComponent
        :userWalletId="userWallet.id"
      ></ModalDeleteUserWalletComponent>
    </BTh>
  </BTr>
</template>

<script>
import ModalDeleteUserWalletComponent from '@/components/user-wallet/modal/ModalDeleteUserWalletComponent';
import ModalUpdateUserWalletComponent from '@/components/user-wallet/modal/ModalUpdateUserWalletComponent';

export default {
  name: 'UserWalletRowComponent',
  components: {
    ModalDeleteUserWalletComponent,
    ModalUpdateUserWalletComponent
  },
  data() {
    return {
      userWalletIsChange: false
    };
  },
  props: {
    userWallet: {
      id: Number,
      info: String,
      walletType: {
        id: Number,
        name: String,
        walletSymbol: String
      }
    },
    optionsUserWallets: Array
  }
};
</script>

<style scoped></style>
