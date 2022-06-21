<template>
  <BModal :id="`order-details${order.id}`" hide-header hide-footer>
    <BRow>
      <BCol md="7" sm="7">
        <h2 class="font-weight-bold mb-3">
          Детали заказа
        </h2>
        <ProductPropertiesListComponent
          v-if="order.product"
          :product="order.product"
          :propertiesValues="order.product.propertiesValue"
        />
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
      <BCol
        lg="5"
        md="5"
        sm="9"
        offset-md="0"
        offset-sm="3"
        v-if="order.status && isNeedOrderConfirmCard"
      >
        <ConfirmOrderCard :order="order" />
      </BCol>
    </BRow>
  </BModal>
</template>

<script>
import ConfirmOrderCard from '@/components/my-order/ConfirmOrderCard';
import ProductPropertiesListComponent from '@/components/product/product-details/product-params/ProductPropertiesListComponent';

export default {
  name: 'ModalDetailsInfoComponent',
  components: {
    ConfirmOrderCard,
    ProductPropertiesListComponent
  },
  props: {
    order: Object
  },
  computed: {
    isNeedOrderConfirmCard() {
      return this.order.status.value === this.$getConst('ORDER_STATUS').CREATED;
    }
  },
  methods: {
    closeModal() {
      this.$bvModal.hide(`finance-details${this.financeOperation.id}`);
    }
  }
};
</script>

<style scoped></style>
