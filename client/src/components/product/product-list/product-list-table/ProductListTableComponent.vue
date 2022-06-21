<template>
  <BTableSimple borderless hover>
    <BThead class="border-bottom pb-3">
      <BTr>
        <BTh class="font-weight-normal">Описание</BTh>
        <BTh class="font-weight-normal">Продавец</BTh>
        <BTh v-if="availableProperties.includes('availability')">
          <BButton
            size="sm"
            variant="white"
            @click="selectSortType('availability')"
            class="font-weight-normal pointer-event shadow-none p-0 m-0"
          >
            Наличие
            <span class="ml-1">
              <FontAwesomeIcon
                :icon="['fas', selectAvailabilitySortIcon]"
              /> </span
          ></BButton>
        </BTh>
        <BTh class="text-md-right">
          <BButton
            size="sm"
            variant="white"
            @click="selectSortType('price')"
            class="font-weight-normal pointer-event shadow-none p-0 m-0"
          >
            Цена
            <span v-if="currentCategory.id === 1">
              /1кк
            </span>
            <span class="ml-1">
              <FontAwesomeIcon :icon="['fas', selectPriceSortIcon]" />
            </span>
          </BButton>
        </BTh>
      </BTr>
    </BThead>
    <BTbody>
      <template
        v-for="product in products(
          sortType,
          sortDirection,
          firstFilter,
          secondFilter,
          search,
          onlyOnline,
          betweenFilter
        )"
      >
        <ProductRow
          :key="product.id"
          :product="product"
          :properties="properties"
          :currentCategory="currentCategory"
          :availableProperties="availableProperties"
        ></ProductRow>
      </template>
    </BTbody>
  </BTableSimple>
</template>

<script>
import ProductRow from '@/components/product/product-list/product-list-table/ProductRow';
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
      sortType: '',
      sortDirection: '',
      availableProperties: []
    };
  },
  props: {
    currentCategory: {
      hasAvailability: Boolean
    },
    properties: Array,
    firstFilter: Array,
    secondFilter: Array,
    onlyOnline: Boolean,
    search: String,
    betweenFilter: Object
  },
  computed: {
    ...mapGetters('Product', {
      products: productGetters.GET_PRODUCTS
    }),

    selectPriceSortIcon() {
      if (this.sortType === 'price') {
        return this.sortDirection === 'DESC' ? 'caret-up' : 'caret-down';
      }
      return 'sort';
    },

    selectAvailabilitySortIcon() {
      if (this.sortType === 'availability') {
        return this.sortDirection === 'DESC' ? 'caret-up' : 'caret-down';
      }
      return 'sort';
    }
  },
  methods: {
    ...mapActions('Product', {
      getProducts: productActions.GET_PRODUCTS
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    selectSortType(sortType) {
      this.sortType = sortType;
      this.sortDirection = this.sortDirection === 'DESC' ? 'ASC' : 'DESC';
    },

    async setProducts() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);
      try {
        await this.getProducts({
          categoryId: currentCategoryId,
          orderType: this.orderType,
          orderDirection: this.orderDirection
        });
        this.getAvailableProperties();
      } catch (error) {
        this.setErrorNotification(error);
      }
    },

    getAvailableProperties() {
      let availableProperties = [];

      Object.values(this.properties).map(property => {
        availableProperties.push(property.inputName);
      });
      return (this.availableProperties = availableProperties);
    }
  },

  async mounted() {
    await this.setProducts();
  },
  watch: {
    $route: ['setProducts'],
    firstFilter: ['setProducts'],
    secondFilter: ['setProducts'],
    onlyOnline: ['setProducts'],
    search: ['setProducts'],
    betweenFilter: ['setProducts']
  }
};
</script>

<style scoped></style>
