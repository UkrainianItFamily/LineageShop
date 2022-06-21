<template>
  <BTr>
    <BTh># {{ order.id }}</BTh>
    <BTh>{{ order.customer.login }}</BTh>
    <BTh>{{ order.seller.login }}</BTh>
    <BTh>{{ order.status.title }}</BTh>
    <BTh>
      <BDropdown
        size="sm"
        text="Изменить статус заказа"
        variant="primary"
        :toggle-class="'shadow-none'"
      >
        <BDropdownItem
          @click="onChangeOrderStatus($getConst('ORDER_STATUS').CREATED)"
          >Создан</BDropdownItem
        >
        <BDropdownItem
          @click="onChangeOrderStatus($getConst('ORDER_STATUS').CLOSED)"
          >Закрыт</BDropdownItem
        >
      </BDropdown>
    </BTh>
  </BTr>
</template>

<script>
import * as orderActions from '@/store/modules/order/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'OrderAdminPanelRow',
  props: {
    order: {
      id: Number,
      customer: Object,
      seller: Object,
      status: {
        title: String,
        value: Number
      }
    }
  },
  data() {
    return {
      changeOrderStatusData: {
        id: this.order.id,
        status: this.order.status.value
      }
    };
  },
  methods: {
    ...mapActions('order', {
      changeOrderStatus: orderActions.CHANGE_ORDER_STATUS
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION,
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    async onChangeOrderStatus(status) {
      this.changeOrderStatusData.status = status;

      try {
        await this.changeOrderStatus(this.changeOrderStatusData);
        await this.setSuccessNotification('Данные заказа изменены');
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
