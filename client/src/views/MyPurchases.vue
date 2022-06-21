<template>
  <BContainer>
    <BRow class="page-title border-0 mb-0">
      <BCol>
        <h1>Мои покупки</h1>
      </BCol>
    </BRow>
    <BRow>
      <BCol md="3">
        <BFormInput
          @input="purchaseId"
          type="text"
          placeholder="Поиск по ID заказа"
          v-model="purchaseId"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormInput
          @input="sellerLogin"
          type="text"
          placeholder="Поиск по продавцу"
          v-model="sellerLogin"
          class="shadow-none"
          size="sm"
        />
      </BCol>
      <BCol md="3">
        <BFormSelect
          v-model="purchaseStatus"
          size="sm"
          @change="purchaseStatus"
        >
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
        <BButton
          @click="fetchPurchasesByCriteria"
          class="shadow-none"
          size="sm"
        >
          Показать
        </BButton>
      </BCol>
    </BRow>
    <BRow>
      <PurchasesListTableComponent
        v-if="setOrderType"
        :orders="purchases"
        :orderType="setOrderType"
        class="mt-2"
      />
      <EmptyPurchasesComponent v-else />
    </BRow>
  </BContainer>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as orderGetters from '@/store/modules/order/types/getters';
import * as orderActions from '@/store/modules/order/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import PurchasesListTableComponent from '@/components/my-order/PurchasesListTableComponent';
import EmptyPurchasesComponent from '@/components/my-order/EmptyPurchasesComponent';
import _ from 'lodash';

export default {
  name: 'MyPurchases',
  components: {
    PurchasesListTableComponent,
    EmptyPurchasesComponent
  },
  data() {
    return {
      purchaseId: '',
      sellerLogin: '',
      purchaseStatus: ''
    };
  },
  computed: {
    ...mapGetters('order', {
      purchases: orderGetters.GET_PURCHASES
    }),
    setOrderType() {
      if (!_.isEmpty(this.purchases)) {
        return this.$getConst('ORDER_TYPE').PURCHASES;
      }
      return null;
    }
  },
  methods: {
    ...mapActions('order', {
      getPurchasesForCurrentUser: orderActions.GET_PURCHASES
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    fetchPurchasesByCriteria() {
      let data = {
        orderId: this.purchaseId,
        sellerLogin: this.sellerLogin,
        orderStatus: this.purchaseStatus
      };
      this.getPurchasesForCurrentUser(data);
    }
  },

  async mounted() {
    try {
      await this.getPurchasesForCurrentUser();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
