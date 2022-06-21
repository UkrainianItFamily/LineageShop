<template>
  <BModal @hide="closeModal" id="add-user-wallet" hide-footer>
    <template #modal-title>
      <h2 class="font-weight-bold">Добавить новый кошелек</h2>
    </template>
    <BFormGroup>
      <label class="text-uppercase text-secondary fa-xs"
        >выберите тип кошелька</label
      >
      <BFormSelect
        v-model="addForm.walletTypeId"
        :options="optionsUserWallets"
        class="shadow-none"
      ></BFormSelect>
    </BFormGroup>
    <BFormGroup>
      <label class="text-uppercase text-secondary fa-xs">добавить карту</label>
      <BFormInput v-model="addForm.info" class="shadow-none"></BFormInput>
    </BFormGroup>
    <BButton @click="onAddUserWallet" class="col-12 mb-2" variant="primary"
      >Добавить</BButton
    >
  </BModal>
</template>

<script>
import * as userWalletActions from '@/store/modules/user-wallet/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'ModalAddUserWalletComponent',
  data() {
    return {
      addForm: {
        info: null,
        walletTypeId: null
      }
    };
  },
  props: {
    optionsUserWallets: Array
  },

  methods: {
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    ...mapActions('UserWallet', {
      addUserWallet: userWalletActions.ADD_USER_WALLET
    }),
    closeModal() {
      this.$bvModal.hide('add-user-wallet');
      this.addForm.info = null;
      this.addForm.walletTypeId = null;
    },
    async onAddUserWallet() {
      await this.addUserWallet(this.addForm);
      await this.closeModal();
      await this.setSuccessNotification('Кошелек добавлен.');
    }
  }
};
</script>

<style scoped></style>
