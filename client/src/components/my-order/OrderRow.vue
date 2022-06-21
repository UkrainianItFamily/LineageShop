<template>
  <BTr>
    <BTh class="font-weight-normal">
      <div>{{ order.date | moment('DD MMMM, H:MM') }}</div>
      <div class="text-secondary">
        {{ order.date | moment('from') }}
      </div>
    </BTh>
    <BTh class="font-weight-normal">
      <RouterLink
        v-if="order.product.id"
        :to="{ name: 'ConfirmOrder', params: { orderId: order.id } }"
        class="text-decoration-none text-dark"
      >
        #{{ order.id }}
      </RouterLink>
    </BTh>
    <BTh class="font-weight-normal w-50" v-b-modal="`order-details${order.id}`">
      <span v-if="order.description">
        {{ order.description }}
      </span>
      <span v-else>
        {{ order.product.name }} {{ order.product.subProperty.value }}
        {{ order.product.rank.value }}
      </span>
    </BTh>
    <BTh class="font-weight-normal">
      <SellerColumn :user="getUserDataByOrderType" />
    </BTh>
    <BTh class="font-weight-bold" :class="`text-${order.status.variant}`">
      {{ order.status.title }}
    </BTh>
    <BTh class="font-weight-bold text-right">{{ order.price }} ₽</BTh>
    <ModalDetailsInfoComponent :order="order" />
  </BTr>
</template>

<script>
import SellerColumn from '@/components/my-order/SellerColumn';
import ModalDetailsInfoComponent from '@/components/my-order/modal/ModalDetailsInfoComponent';

export default {
  name: 'OrderRow',
  components: {
    SellerColumn,
    ModalDetailsInfoComponent
  },
  props: {
    orderType: Number,
    order: {
      id: Number,
      date: String,
      productId: Number,
      description: String,
      status: {
        value: Number,
        title: String,
        variant: String
      },
      customer: {
        id: Number,
        login: String,
        online: Number,
        userPhoto: String,
        createdAt: String
      },
      seller: {
        id: Number,
        login: String,
        online: Number,
        userPhoto: String,
        createdAt: String
      },
      price: Number
    }
  },
  computed: {
    getUserDataByOrderType() {
      if (this.orderType === this.$getConst('ORDER_TYPE').PURCHASES) {
        return this.order.seller;
      }
      return this.order.customer;
    }
  }
};
</script>

<style scoped></style>
