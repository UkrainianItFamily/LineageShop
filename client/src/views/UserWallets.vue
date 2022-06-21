<template>
  <BContainer>
    <TitleComponent>Кошельки</TitleComponent>
    <div v-if="userWalletsIsEmpty">У вас пока нет кошельков</div>
    <div v-else>
      <BCol cols="12" class="pt-3">
        <BTableSimple>
          <BThead class="border-bottom pb-3">
            <BTr>
              <BTh>Тип карты</BTh>
              <BTh>Карта</BTh>
              <BTh> </BTh>
              <BTh> </BTh>
            </BTr>
          </BThead>
          <BTbody>
            <UserWalletRowComponent
              v-for="userWallet in userWallets"
              :key="userWallet.id"
              :userWallet="userWallet"
              :optionsUserWallets="optionsUserWallets"
            ></UserWalletRowComponent>
          </BTbody>
        </BTableSimple>
      </BCol>
    </div>
    <BButton
      v-b-modal.add-user-wallet
      variant="primary"
      class="shadow-none mt-3 font-weight-bold"
      >Добавить</BButton
    >
    <ModalAddUserWalletComponent
      :optionsUserWallets="optionsUserWallets"
    ></ModalAddUserWalletComponent>
  </BContainer>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import UserWalletRowComponent from '@/components/user-wallet/UserWalletRowComponent';
import ModalAddUserWalletComponent from '@/components/user-wallet/modal/ModalAddUserWalletComponent';
import * as userWalletsGetters from '@/store/modules/user-wallet/types/getters';
import * as userWalletsActions from '@/store/modules/user-wallet/types/actions';
import * as walletTypesGetters from '@/store/modules/wallet-type/types/getters';
import * as walletTypesActions from '@/store/modules/wallet-type/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'UserWallets',
  components: {
    TitleComponent,
    UserWalletRowComponent,
    ModalAddUserWalletComponent
  },
  computed: {
    ...mapGetters('UserWallet', {
      userWallets: userWalletsGetters.GET_USER_WALLETS
    }),
    ...mapGetters('WalletType', {
      walletTypes: walletTypesGetters.GET_WALLET_TYPES
    }),
    optionsUserWallets() {
      let optionsUserWallet = [{ value: null, text: '' }];
      _.map(this.walletTypes, function(userWallet) {
        optionsUserWallet.push({
          value: userWallet.id,
          text: userWallet.name
        });
      });
      return optionsUserWallet;
    },
    userWalletsIsEmpty() {
      return _.isEmpty(this.userWallets);
    }
  },
  methods: {
    ...mapActions('UserWallet', {
      getUserWallets: userWalletsActions.GET_USER_WALLETS
    }),
    ...mapActions('WalletType', {
      getWalletTypes: walletTypesActions.GET_WALLET_TYPES
    }),
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    })
  },

  async mounted() {
    try {
      await this.getWalletTypes();
      await this.getUserWallets();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
