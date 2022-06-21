<template>
  <BTableSimple hover>
    <BThead class="border-bottom pb-3">
      <BTr>
        <BTh class="font-weight-bold">Дата</BTh>
        <BTh class="font-weight-bold">Заказ</BTh>
        <BTh class="font-weight-bold">Описание</BTh>
        <BTh class="font-weight-bold">Покупатель</BTh>
        <BTh class="font-weight-bold">Статус</BTh>
        <BTh class="font-weight-bold text-right">Сумма</BTh>
      </BTr>
    </BThead>
    <BTbody>
      <template v-for="order in orders">
        <OrderRow
          :key="order.id"
          :order="order"
          :orderType="orderType"
        ></OrderRow>
      </template>
    </BTbody>
  </BTableSimple>
</template>

<script>
import OrderRow from '@/components/my-order/OrderRow';

export default {
  name: 'SalesListTableComponent',
  components: {
    OrderRow
  },
  props: {
    orderType: Number,
    orders: Object
  }
};
</script>

<style scoped></style>
