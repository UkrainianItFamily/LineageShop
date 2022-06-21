<template>
  <BCard class="mb-2">
    <h5 class="unique-font">
      Способ оплаты
    </h5>
    <div class="mb-4">
      <span>
        <FontAwesomeIcon
          :icon="['fas', 'credit-card']"
          size="1x"
          class="mr-2"
        /> </span
      >{{ order.walletType.name }}
    </div>
    <h5 class="unique-font">
      Сумма оплаты
    </h5>
    <div class="fa-lg font-weight-bold mb-4">
      {{ order.orderPrice }}
      <span class="fa-xs">{{ order.walletType.walletSymbol }}</span>
    </div>
    <BButton
      v-if="order.walletType.id === this.$getConst('WALLET_TYPES').BALANCE"
      @click="onConfirmOrder"
      block
      href="#"
      variant="primary"
      class="font-weight-bold shadow-none mb-2"
    >
      Оплатить
    </BButton>
    <BButton
      v-else
      @click="onConfirmOrder"
      block
      href="#"
      variant="primary"
      class="font-weight-bold shadow-none mb-2"
    >
      Оплатить
    </BButton>
    <BCardText class="text-secondary">
      Продавец не сможет получить оплату до тех пор, пока вы не подтвердите
      выполнение им всех обязательств.
    </BCardText>
  </BCard>
</template>

<script>
import * as orderActions from '@/store/modules/order/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'ConfirmOrderCard',
  props: {
    order: {
      id: Number,
      walletType: {
        name: String,
        walletSymbol: String
      },
      orderPrice: Number
    }
  },
  methods: {
    ...mapActions('order', {
      confirmOrder: orderActions.CONFIRM_ORDER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async onConfirmOrder() {
      let data = {
        orderId: this.order.id,
        orderPrice: this.order.orderPrice
      };
      try {
        await this.confirmOrder(data);
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
