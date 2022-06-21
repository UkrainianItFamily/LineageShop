<template>
  <BModal :id="`finance-cancel${financeOperation.id}`" hide-header hide-footer>
    <BContainer>
      <h2 class="font-weight-bold">
        Информация об отмене
      </h2>
      <BRow class="font-weight-bold text-secondary pt-3">
        Причина отмены
      </BRow>
      <BRow class="pt-3">
        <BFormTextarea placeholder="Причина отмены" v-model="cancelInfo" />
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Номер вывода
        </BCol>
        <BCol md="8"> #{{ financeOperation.id }} </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Логин получателя
        </BCol>
        <BCol md="8">{{ financeOperation.user.login }} </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          E-mail поулчателя
        </BCol>
        <BCol md="8">{{ financeOperation.user.email }} </BCol>
      </BRow>
      <BRow class="pt-3" v-if="financeOperation.wallet.id">
        <BCol md="4" class="font-weight-bold text-secondary">
          Тип кошелька
        </BCol>
        <BCol md="8">
          {{ financeOperation.wallet.walletType.name }}
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          Сумма
        </BCol>
        <BCol md="8">
          <span v-if="!financeOperation.type.isEnrollment">
            -
          </span>
          {{ financeOperation.money }} ₽
        </BCol>
      </BRow>
      <BRow class="pt-3">
        <BCol md="4" class="font-weight-bold text-secondary">
          <span>Кошелёк</span>
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
        <BCol md="5">
          <BButton
            v-if="isNeedButtonCanceled"
            class="font-weight-bold"
            variant="danger"
            @click="onChangeStatusFinanceOperation"
            >Отменить вывод</BButton
          >
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
  name: 'ModalCancelInfoComponent',
  data() {
    return {
      status: this.$getConst('FINANCE_OPERATION_STATUS').EXECUTED,
      cancelInfo: ''
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
    isNeedButtonCanceled() {
      return !(
        this.financeOperation.status.isExecuted ||
        this.financeOperation.status.isCanceled
      );
    }
  },
  methods: {
    closeModal() {
      this.$bvModal.hide(`finance-cancel${this.financeOperation.id}`);
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
        let data = {
          financeOperationId: this.financeOperation.id,
          cancelInfo: this.cancelInfo
        };
        await this.changeStatusFinanceOperation(data);
        await this.closeModal();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
