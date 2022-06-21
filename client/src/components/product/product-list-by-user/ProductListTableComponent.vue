<template>
  <BTableSimple borderless hover>
    <BThead class="border-bottom pb-3">
      <BTr>
        <BTh class="font-weight-normal">Описание</BTh>
        <BTh v-if="hasAvailability" class="font-weight-normal">Наличие</BTh>
        <BTh class="font-weight-normal text-md-right">Цена</BTh>
      </BTr>
    </BThead>
    <BTbody>
      <template v-for="product in productsForUser">
        <ProductRow
          :hasAvailability="hasAvailability"
          :key="product.id"
          :product="product"
          @getEditProduct="$emit('openEditModal', product.id)"
        />
      </template>
    </BTbody>
  </BTableSimple>
</template>

<script>
import ProductRow from '@/components/product/product-list-by-user/ProductRow';
import * as productGetters from '@/store/modules/product/types/getters';
import * as productActions from '@/store/modules/product/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import Vue from 'vue';

export default {
  name: 'ProductListTableComponent',
  components: { ProductRow },
  data() {
    return {
      orderType: '',
      orderDirection: ''
    };
  },
  props: {
    hasAvailability: Boolean
  },
  computed: {
    ...mapGetters('Product', {
      productsForUser: productGetters.GET_PRODUCTS_FOR_USER
    })
  },
  methods: {
    ...mapActions('Product', {
      getProductsForUser: productActions.GET_PRODUCTS_FOR_USER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    setCurrentUserProducts() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

      this.getProductsForUser({
        categoryId: currentCategoryId,
        orderType: this.orderType,
        orderDirection: this.orderDirection
      });
    }
  },
  async mounted() {
    try {
      await this.setCurrentUserProducts();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },
  watch: {
    $route: 'setCurrentUserProducts'
  }
};
</script>

<style scoped></style>
