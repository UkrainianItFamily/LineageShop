<template>
  <BModal
    @hide="closeModal"
    :id="`update-user-wallet-${userWallet.id}`"
    hide-footer
  >
    <template #modal-title>
      <h2 class="font-weight-bold">Изменить кошелек</h2>
    </template>
    <BFormGroup>
      <label class="text-uppercase text-secondary fa-xs">Тип кошелька</label>
      <BFormSelect
        v-model="updateData.walletTypeId"
        :options="optionsUserWallets"
        class="shadow-none"
      ></BFormSelect>
    </BFormGroup>
    <BFormGroup>
      <label class="text-uppercase text-secondary fa-xs">изменить карту</label>
      <BFormInput v-model="updateData.info" class="shadow-none"></BFormInput>
    </BFormGroup>
    <BButton @click="onUpdateUserWallet" class="col-12 mb-2" variant="primary"
      >Сохранить</BButton
    >
  </BModal>
</template>

<script>
import * as userWalletActions from '@/store/modules/user-wallet/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'ModalUpdateUserWalletComponent',
  data() {
    return {
      updateData: {
        id: this.userWallet.id,
        info: this.userWallet.info,
        walletTypeId: this.userWallet.walletType.id
      }
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
  },

  methods: {
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    ...mapActions('UserWallet', {
      updateUserWallet: userWalletActions.UPDATE_USER_WALLET
    }),
    closeModal() {
      this.$bvModal.hide(`update-user-wallet-${this.userWallet.id}`);
      this.updateData.info = this.userWallet.info;
      this.updateData.walletTypeId = this.userWallet.walletType.id;
    },
    async onUpdateUserWallet() {
      await this.updateUserWallet(this.updateData);
      await this.closeModal();
      await this.setSuccessNotification('Кошелек изменен.');
    }
  }
};
</script>

<style scoped></style>
