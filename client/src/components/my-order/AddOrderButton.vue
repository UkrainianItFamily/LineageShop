<template>
  <div>
    <BButton
      @click="onAddOrder"
      variant="primary"
      class="w-100 font-weight-bold shadow-none"
      >Купить
    </BButton>
  </div>
</template>

<script>
import * as orderActions from '@/store/modules/order/types/actions';
import * as orderGetters from '@/store/modules/order/types/getters';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'AddOrderButton',
  props: {
    productId: Number,
    userId: Number,
    paramsOrderData: {
      nickname: String,
      walletTypeId: Number,
      quantity: Number
    },
    productAvailability: Number
  },
  computed: {
    ...mapGetters('order', {
      order: orderGetters.GET_ORDER
    })
  },
  methods: {
    ...mapActions('order', {
      addOrder: orderActions.ADD_ORDER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async onAddOrder() {
      try {
        if (this.paramsOrderData.walletTypeId) {
          if (this.productAvailability >= this.paramsOrderData.quantity) {
            await this.addOrder({
              productId: this.productId,
              userSellerId: this.userId,
              walletTypeId: this.paramsOrderData.walletTypeId,
              nickname: this.paramsOrderData.nickname,
              quantity: this.paramsOrderData.quantity
            });
            await this.$router.push({
              name: 'ConfirmOrder',
              params: { orderId: this.order.id }
            });
          } else {
            this.setErrorNotification(
              'Выбранное колличество товара превышает доступное'
            );
          }
        } else {
          this.setErrorNotification('Выберите тип оплаты');
        }
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
