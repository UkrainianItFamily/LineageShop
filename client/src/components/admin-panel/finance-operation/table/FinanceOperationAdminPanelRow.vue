<template>
  <BTr>
    <BTh># {{ financeOperation.id }}</BTh>
    <BTh>{{ financeOperation.user.login }}</BTh>
    <BTh>{{ financeOperation.type.title }}</BTh>
    <BTh>{{ financeOperation.status.title }}</BTh>
    <BTh>
      {{ financeOperation.createdAt | moment('Y.m.D HH:mm') }}
    </BTh>
    <BTh>
      <BButton
        v-if="financeOperation.status.value === 1"
        @click="
          onChangeFinanceOperationStatus(
            $getConst('FINANCE_OPERATION_STATUS').PENDING
          )
        "
        variant="primary"
        class="shadow-none"
      >
        Взять в работу
      </BButton>
      <BButton
        v-if="financeOperation.status.value === 3"
        @click="
          onChangeFinanceOperationStatus(
            $getConst('FINANCE_OPERATION_STATUS').EXECUTED
          )
        "
        variant="primary"
        class="shadow-none"
      >
        Выполнено
      </BButton>
    </BTh>
    <BTh>
      <BButton
        v-if="
          financeOperation.status.value === 1 ||
            financeOperation.status.value === 3
        "
        @click="showCancelModal()"
        variant="outline-danger"
        class="shadow-none ml-3"
      >
        Отменить
      </BButton>
    </BTh>
    <BTh @click="showDetailModal" style="cursor: pointer">
      <FontAwesomeIcon
        :icon="['fas', 'chevron-right']"
        size="1x"
        class="text-primary ml-1"
      />
    </BTh>
    <ModalDetailsInfoComponent :financeOperation="financeOperation" />
    <ModalCancelInfoComponent :financeOperation="financeOperation" />
  </BTr>
</template>

<script>
import * as financeOperationActions from '@/store/modules/finance-operation/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';
import ModalDetailsInfoComponent from '@/components/admin-panel/finance-operation/modal/ModalDetailsInfoComponent.vue';
import ModalCancelInfoComponent from '@/components/admin-panel/finance-operation/modal/ModalCancelInfoComponent';
export default {
  name: 'FinanceOperationAdminPanelRow',
  components: {
    ModalDetailsInfoComponent,
    ModalCancelInfoComponent
  },
  data() {
    return {
      changeStatusData: {
        id: this.financeOperation.id,
        status: this.financeOperation.status.value
      },
      show: false
    };
  },
  props: {
    financeOperation: {
      id: Number,
      user: {
        login: String
      },
      status: {
        title: String,
        variant: String,
        value: Number
      }
    }
  },
  methods: {
    ...mapActions('FinanceOperation', {
      changeFinanceOperationStatus:
        financeOperationActions.CHANGE_STATUS_FINANCE_OPERATION
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async onChangeFinanceOperationStatus(newStatus) {
      this.changeStatusData.status = newStatus;
      try {
        await this.changeFinanceOperationStatus(this.changeStatusData);
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    showDetailModal() {
      this.$bvModal.show(`finance-details${this.financeOperation.id}`);
    },
    showCancelModal() {
      this.$bvModal.show(`finance-cancel${this.financeOperation.id}`);
    }
  }
};
</script>

<style scoped></style>
