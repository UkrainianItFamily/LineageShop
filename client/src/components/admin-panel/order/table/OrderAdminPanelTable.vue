<template>
  <BRow>
    <BCol cols="12">
      <BTableSimple borderless hover>
        <BThead class="border-bottom pb-3">
          <BTr>
            <BTh>ID</BTh>
            <BTh>Покупатель</BTh>
            <BTh>Продавец</BTh>
            <BTh>Статус заказа</BTh>
            <BTh> </BTh>
          </BTr>
        </BThead>
        <BTbody>
          <OrderAdminPanelRow
            v-for="order in orders"
            :key="order.id"
            :order="order"
          ></OrderAdminPanelRow>
        </BTbody>
      </BTableSimple>
    </BCol>
  </BRow>
</template>

<script>
import OrderAdminPanelRow from './OrderAdminPanelRow';

export default {
  name: 'OrderAdminPanelTable',
  components: {
    OrderAdminPanelRow
  },
  props: {
    orders: Object
  }
};
</script>

<style scoped></style>
