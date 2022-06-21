<template>
  <BContainer>
    <BRow class="page-title border-0 mb-0">
      <BCol>
        <h1>Мои продажи</h1>
      </BCol>
    </BRow>
    <BRow>
      <BCol md="3">
        <BFormInput
          @input="saleId"
          type="text"
          placeholder="Поиск по ID заказа"
          v-model="saleId"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormInput
          @input="customerLogin"
          type="text"
          placeholder="Поиск по покупателю"
          v-model="customerLogin"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormSelect v-model="saleStatus" size="sm" @change="saleStatus">
          <BFormSelectOption value="">
            Поиск по статусу
          </BFormSelectOption>
          <BFormSelectOption :value="$getConst('ORDER_STATUS').CREATED">
            Создан
          </BFormSelectOption>
          <BFormSelectOption :value="$getConst('ORDER_STATUS').CLOSED">
            Закрыт
          </BFormSelectOption>
          <BFormSelectOption :value="$getConst('ORDER_STATUS').CONFIRMED">
            Подтвержден
          </BFormSelectOption>
        </BFormSelect>
      </BCol>
      <BCol md="3">
        <BButton @click="fetchSalesByCriteria" class="shadow-none" size="sm">
          Показать
        </BButton>
      </BCol>
    </BRow>
    <BRow class="mt-2">
      <SalesListTableComponent
        v-if="setOrderType"
        :orders="sales"
        :orderType="setOrderType"
      />
      <EmptySalesComponent v-else />
    </BRow>
  </BContainer>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as orderGetters from '@/store/modules/order/types/getters';
import * as orderActions from '@/store/modules/order/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import SalesListTableComponent from '@/components/my-order/SalesListTableComponent';
import EmptySalesComponent from '@/components/my-order/EmptySalesComponent';
import _ from 'lodash';

export default {
  name: 'MySales',
  components: {
    SalesListTableComponent,
    EmptySalesComponent
  },
  data() {
    return {
      saleId: '',
      customerLogin: '',
      saleStatus: ''
    };
  },
  computed: {
    ...mapGetters('order', {
      sales: orderGetters.GET_SALES
    }),
    setOrderType() {
      if (!_.isEmpty(this.sales)) {
        return this.$getConst('ORDER_TYPE').SALES;
      }
      return null;
    }
  },
  methods: {
    ...mapActions('order', {
      getSalesForCurrentUser: orderActions.GET_SALES
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    fetchSalesByCriteria() {
      let data = {
        orderId: this.saleId,
        customerLogin: this.customerLogin,
        orderStatus: this.saleStatus
      };
      this.getSalesForCurrentUser(data);
    }
  },

  async mounted() {
    try {
      await this.getSalesForCurrentUser();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
