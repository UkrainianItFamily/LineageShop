<template>
  <BRow>
    <BCol md="2" sm="3">
      <BButton
        @click="toBackPage"
        variant="white"
        class="d-flex align-items-center position-relative pl-3 mb-3 shadow-none text-primary"
      >
        <FontAwesomeIcon
          :icon="['fas', 'chevron-left']"
          size="1x"
          class="back-link-icon"
        />
        <span class="font-weight-bold">Назад</span>
      </BButton>
    </BCol>
    <BCol md="5" sm="9">
      <h2 class="font-weight-bold mb-3">
        Подтверждение заказа
      </h2>
      <ProductPropertiesListComponent
        v-if="order.product"
        :product="order.product"
        :propertiesValues="order.product.propertiesValue"
      ></ProductPropertiesListComponent>
      <hr />
      <BRow>
        <BCol cols="12" md="6">
          <div class="mb-3">
            <h5 class="rating-title unique-font">
              Кол-во
            </h5>
            <span class="font-weight-bold">{{ order.quantity }}</span>
          </div>
          <div v-if="order.nickname" class="mb-3">
            <h5 class="rating-title unique-font">
              Имя персонажа
            </h5>
            <span class="font-weight-bold">{{ order.nickname }}</span>
          </div>
        </BCol>
      </BRow>
    </BCol>
    <BCol lg="3" md="4" sm="9" offset-md="0" offset-sm="3">
      <ConfirmOrderCard
        v-if="order.status && isNeedOrderConfirmCard"
        :order="order"
      ></ConfirmOrderCard>
    </BCol>
  </BRow>
</template>

<script>
import ConfirmOrderCard from '@/components/my-order/ConfirmOrderCard';
import ProductPropertiesListComponent from '@/components/product/product-details/product-params/ProductPropertiesListComponent';
import * as orderActions from '@/store/modules/order/types/actions';
import * as orderGetters from '@/store/modules/order/types/getters';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'ConfirmOrderComponent',
  components: {
    ConfirmOrderCard,
    ProductPropertiesListComponent
  },
  computed: {
    ...mapGetters('order', {
      order: orderGetters.GET_ORDER
    }),
    isNeedOrderConfirmCard() {
      return this.order.status.value === this.$getConst('ORDER_STATUS').CREATED;
    }
  },
  methods: {
    ...mapActions('order', {
      getOrder: orderActions.GET_ORDER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    toBackPage() {
      return window.history.length > 2
        ? this.$router.go(-1)
        : this.$router.push('/');
    },
    async setOrder() {
      try {
        await this.getOrder(this.$route.params.orderId);
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  },
  async mounted() {
    await this.setOrder();
  }
};
</script>

<style scoped></style>
