<template>
  <BModal :id="`delete-user-wallet-${userWalletId}`" hide-header hide-footer>
    <h4 class="text-center mt-3 mb-5">Удалить этот кошелек?</h4>
    <BButton
      @click="onDeleteUserWallet"
      class="col-12 mb-2 text-uppercase font-weight-bold shadow-none"
      variant="primary"
      >подтвердить</BButton
    >
    <BButton
      @click="closeModal"
      class="col-12 mb-2 text-uppercase font-weight-bold shadow-none"
      variant="danger"
      >отменить</BButton
    >
  </BModal>
</template>

<script>
import * as userWalletActions from '@/store/modules/user-wallet/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'ModalDeleteUserWalletComponent',
  props: {
    userWalletId: Number
  },
  methods: {
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    ...mapActions('UserWallet', {
      deleteUserWallet: userWalletActions.DELETE_USER_WALLET
    }),
    async onDeleteUserWallet() {
      await this.deleteUserWallet(this.userWalletId);
      await this.setSuccessNotification('Кошелек удален.');
    },
    closeModal() {
      this.$bvModal.hide(`delete-user-wallet-${this.userWalletId}`);
    }
  }
};
</script>

<style scoped></style>
