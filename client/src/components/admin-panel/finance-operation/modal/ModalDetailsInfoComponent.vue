<template>
  <BModal :id="`finance-details${financeOperation.id}`" hide-header hide-footer>
    <BContainer>
      <h2 class="font-weight-bold">
        Информация об операции
      </h2>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Дата запроса
        </BCol>
        <BCol md="8">
          {{ financeOperation.createdAt | moment('Y.m.D HH:mm') }}

          <span class="text-secondary">
            ({{ financeOperation.createdAt | moment('from') }})
          </span>
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Описание
        </BCol>
        <BCol md="8">
          <span>{{ financeOperation.type.title }}</span>
          денег
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Сумма
        </BCol>
        <BCol md="8">
          <span v-if="!financeOperation.type.isEnrollment">-</span>
          {{ financeOperation.money }} ₽
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Статус операции
        </BCol>
        <BCol md="8">
          <p>
            <span :class="`text-${financeOperation.status.variant}`">{{
              financeOperation.status.title
            }}</span>
            <span v-if="financeOperation.status.variant !== ''"> </span>
          </p>
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Номер вывода
        </BCol>
        <BCol md="8"> #{{ financeOperation.id }} </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          <span>Получатель</span>
        </BCol>
        <BCol md="8">
          {{ financeOperation.wallet.info }}
          <FontAwesomeIcon
            :icon="['fas', 'credit-card']"
            size="1x"
            class="ml-1"
          />
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          <span v-if="!financeOperation.type.isEnrollment">К получателю</span>
          <span v-else>У отправителя</span>
        </BCol>
        <BCol md="8">
          <span v-if="financeOperation.type.isEnrollment">
            -
          </span>
          {{ getTransferWithCommission }}
          <span v-if="financeOperation.wallet.walletType">
            {{ financeOperation.wallet.walletType.walletSymbol }}
          </span>
        </BCol>
      </BRow>
      <BRow v-if="!isNeedButtonCanceled" class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          <span>
            Дата отмены
          </span>
        </BCol>
        <BCol md="8">
          {{ financeOperation.canceledAt | moment('Y.m.D HH:mm') }}
        </BCol>
      </BRow>
      <BRow v-if="!isNeedButtonCanceled" class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          <span>
            Причина отмены
          </span>
        </BCol>
        <BCol md="8">
          {{ financeOperation.canceledInfo }}
        </BCol>
      </BRow>
    </BContainer>
  </BModal>
</template>

<script>
import { mapActions } from 'vuex';
import * as financeOperationsActions from '@/store/modules/finance-operation/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ModalDetailsInfoComponent',
  data() {
    return {
      transferWithCommission: null,
      commissionPercentage: 2,
      status: this.$getConst('FINANCE_OPERATION_STATUS').EXECUTED
    };
  },
  props: {
    financeOperation: {
      id: Number,
      money: String,
      status: {
        title: String,
        variant: String,
        value: Number,
        isExecuted: Boolean,
        isCanceled: Boolean
      },
      createdAt: String,
      wallet: {
        id: Number,
        info: String,
        walletType: {
          id: Number,
          name: String,
          walletSymbol: String
        }
      },
      canceledAt: String,
      canceledInfo: String
    }
  },
  computed: {
    getTransferWithCommission() {
      if (
        this.financeOperation.type.value ===
        this.$getConst('FINANCE_OPERATION_TYPE').WRITE_OFFS
      ) {
        return (
          (this.financeOperation.money / 100) *
          (100 - this.commissionPercentage)
        ).toFixed(2);
      }
      return (
        (this.financeOperation.money / 100) *
        (100 + this.commissionPercentage)
      ).toFixed(2);
    },
    isNeedButtonCanceled() {
      return !(
        this.financeOperation.status.isExecuted ||
        this.financeOperation.status.isCanceled
      );
    }
  },
  methods: {
    closeModal() {
      this.$bvModal.hide(`finance-details${this.financeOperation.id}`);
    },
    ...mapActions('FinanceOperation', {
      changeStatusFinanceOperation:
        financeOperationsActions.CHANGE_STATUS_FINANCE_OPERATION_TO_CANCEL
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async onChangeStatusFinanceOperation() {
      try {
        await this.changeStatusFinanceOperation(this.financeOperation.id);
        await this.closeModal();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
