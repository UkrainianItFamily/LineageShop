<template>
  <BContainer>
    <BRow>
      <BCol md="3">
        <BFormInput
          @input="inputId"
          type="text"
          placeholder="Поиск по ID"
          v-model="financeOperationById"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormInput
          @input="inputUserLogin"
          type="text"
          placeholder="Поиск по пользователю"
          v-model="financeOperationByUser"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormSelect v-model="financeOperationsByStatusId" size="sm">
          <BFormSelectOption value="">
            Поиск по статусу
          </BFormSelectOption>
          <BFormSelectOption
            :value="$getConst('FINANCE_OPERATION_STATUS').CREATED"
          >
            Созданно
          </BFormSelectOption>
          <BFormSelectOption
            :value="$getConst('FINANCE_OPERATION_STATUS').EXECUTED"
          >
            Выполненно
          </BFormSelectOption>
          <BFormSelectOption
            :value="$getConst('FINANCE_OPERATION_STATUS').PENDING"
          >
            Ожидание
          </BFormSelectOption>
          <BFormSelectOption
            :value="$getConst('FINANCE_OPERATION_STATUS').CANCELED"
          >
            Отменено
          </BFormSelectOption>
        </BFormSelect>
      </BCol>
      <BCol md="3">
        <BButton @click="onGetFinanceOperationByCriteria" class="shadow-none">
          Искать
        </BButton>
      </BCol>
    </BRow>
    <BRow class="w-75">
      <BCol md="3">
        <BFormDatepicker
          type="text"
          placeholder="От"
          class="shadow-none w-10"
          size="sm"
          :date-format-options="{
            year: 'numeric',
            month: 'numeric',
            day: '2-digit'
          }"
          v-model="financeOperationsStartDate"
        />
      </BCol>
      <BCol md="3">
        <BFormDatepicker
          type="text"
          placeholder="До"
          class="shadow-none w-10"
          size="sm"
          :date-format-options="{
            year: 'numeric',
            month: 'numeric',
            day: '2-digit'
          }"
          v-model="financeOperationsEndDate"
        />
      </BCol>
    </BRow>
    <FinanceOperationAdminPanelTable
      :financeOperations="financeOperations(orderType, orderDirection)"
      @orderParameters="setOrderParameters"
    />
  </BContainer>
</template>

<script>
import FinanceOperationAdminPanelTable from './table/FinanceOperationAdminPanelTable';
import * as financeOperationActions from '@/store/modules/finance-operation/types/actions';
import * as financeOperationGetters from '@/store/modules/finance-operation/types/getters';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'FinanceOperationAdminPanelComponent',
  components: {
    FinanceOperationAdminPanelTable
  },
  data() {
    return {
      financeOperationById: '',
      financeOperationByUser: '',
      financeOperationsByStatusId: '',
      financeOperationsStartDate: '',
      financeOperationsEndDate: '',
      orderType: '',
      orderDirection: ''
    };
  },
  computed: {
    ...mapGetters('FinanceOperation', {
      financeOperations: financeOperationGetters.GET_FINANCE_OPERATIONS
    })
  },
  methods: {
    ...mapActions('FinanceOperation', {
      getFinanceOperations: financeOperationActions.GET_ALL_FINANCE_OPERATIONS
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    inputId() {
      this.financeOperationByUser = '';
    },
    inputUserLogin() {
      this.financeOperationById = '';
    },
    async onGetFinanceOperationByCriteria() {
      await this.setFinanceOperations();
    },
    async setFinanceOperations() {
      try {
        await this.getFinanceOperations({
          orderType: this.orderType,
          orderDirection: this.orderDirection,
          id: this.financeOperationById,
          userLogin: this.financeOperationByUser,
          statusId: this.financeOperationsByStatusId,
          startDate: this.financeOperationsStartDate,
          endDate: this.financeOperationsEndDate
        });
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    async setOrderParameters(orderParameters) {
      this.orderType = orderParameters.orderType;
      this.orderDirection = orderParameters.orderDirection;
      await this.setFinanceOperations();
    }
  },
  async mounted() {
    await this.setFinanceOperations();
  }
};
</script>

<style scoped></style>
