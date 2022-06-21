<template>
  <BModal @hide="closeModal" id="add-finance-operation" hide-footer>
    <template #modal-title>
      <h2 class="font-weight-bold">Вывод средств</h2>
    </template>
    <BForm @submit.prevent="onAddFinanceOperation">
      <BFormGroup>
        <label class="text-uppercase text-secondary fa-xs">способ оплаты</label>
        <BFormSelect
          v-model="addedData.typeId"
          @change="getUserWalletsByWalletType"
          class="shadow-none"
        >
          <BFormSelectOption :value="null">
            Выберите способ оплаты
          </BFormSelectOption>
          <BFormSelectOption
            v-for="walletType in walletTypes"
            :key="walletType.id"
            :value="walletType.id"
          >
            {{ walletType.name }}
          </BFormSelectOption>
        </BFormSelect>
      </BFormGroup>
      <BFormGroup v-if="addedData.typeId">
        <label class="text-uppercase text-secondary fa-xs">кошелек</label>
        <BFormSelect v-model="addedData.walletId" class="shadow-none">
          <BFormSelectOption :value="null">
            Выберите другой кошелек
          </BFormSelectOption>
          <BFormSelectOption
            v-for="userWallet in userWallets"
            :key="userWallet.id"
            :value="userWallet.id"
          >
            {{ userWallet.info }}
          </BFormSelectOption>
        </BFormSelect>
      </BFormGroup>
      <BFormGroup v-if="isShowAddWallet" class="position-relative">
        <label class="text-uppercase text-secondary fa-xs"
          >добавить карту</label
        >
        <BFormInput v-model="addedData.info" class="shadow-none"></BFormInput>
      </BFormGroup>
      <BFormGroup v-if="addedData.typeId" class="position-relative">
        <label class="text-uppercase text-secondary fa-xs">сумма</label>
        <BFormInput
          v-model="addedData.money"
          type="number"
          class="shadow-none"
        />
        <span
          class="currency-symbol position-absolute font-weight-bold ml-2 text-right"
          >₽</span
        >
      </BFormGroup>
      <BFormGroup v-if="addedData.typeId" class="position-relative">
        <label class="text-uppercase text-secondary fa-xs t">к получению</label>
        <BFormInput
          class="bg-light shadow-none"
          :value="getMoneyWithCommission"
        >
        </BFormInput>
        <span
          class="currency-symbol position-absolute font-weight-bold ml-2 text-right"
          >{{ getWalletSymbol }}</span
        >
      </BFormGroup>
      <BButton type="submit" class="col-12 mb-2" variant="primary"
        >Отправить</BButton
      >
    </BForm>
  </BModal>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as walletTypesGetters from '@/store/modules/wallet-type/types/getters';
import * as walletTypesActions from '@/store/modules/wallet-type/types/actions';
import * as userWalletsGetters from '@/store/modules/user-wallet/types/getters';
import * as userWalletsActions from '@/store/modules/user-wallet/types/actions';
import * as financeOperationsActions from '@/store/modules/finance-operation/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ModalFormComponent',
  data() {
    return {
      addedData: {
        money: null,
        type: this.$getConst('FINANCE_OPERATION_TYPE').WRITE_OFFS,
        info: null,
        walletId: null,
        typeId: null
      },
      commissionPercentage: 2
    };
  },
  methods: {
    closeModal() {
      this.$bvModal.hide('add-finance-operation');
      this.addedData.walletId = null;
      this.addedData.typeId = null;
      this.addedData.money = null;
    },
    async getUserWalletsByWalletType() {
      try {
        await this.getUserWallets(this.addedData.typeId);
        this.addedData.walletId = null;
        this.addedData.info = null;
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    async onAddFinanceOperation() {
      try {
        await this.addFinanceOperations(this.addedData);
        await this.closeModal();
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    ...mapActions('FinanceOperation', {
      addFinanceOperations: financeOperationsActions.ADD_FINANCE_OPERATION
    }),
    ...mapActions('WalletType', {
      getWalletTypes: walletTypesActions.GET_WALLET_TYPES
    }),
    ...mapActions('UserWallet', {
      getUserWallets: userWalletsActions.GET_USER_WALLETS_BY_WALLET_TYPE_ID
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    })
  },
  computed: {
    getMoneyWithCommission() {
      return this.addedData.money - this.getMoney;
    },
    getWalletSymbol() {
      return this.walletTypes[this.addedData.typeId].walletSymbol;
    },
    getMoney() {
      return (this.addedData.money / 100) * this.commissionPercentage;
    },
    isShowAddWallet() {
      return !this.addedData.walletId && this.addedData.typeId;
    },
    ...mapGetters('UserWallet', {
      userWallets: userWalletsGetters.GET_USER_WALLETS_BY_WALLET_TYPE_ID
    }),
    ...mapGetters('WalletType', {
      walletTypes: walletTypesGetters.GET_WALLET_TYPES
    })
  },
  async mounted() {
    try {
      await this.getWalletTypes();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped>
.currency-symbol {
  right: 15px;
  top: 56%;
}
</style>
