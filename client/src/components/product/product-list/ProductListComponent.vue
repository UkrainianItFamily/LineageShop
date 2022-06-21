<template>
  <BRow class="mr-3 ml-3">
    <BRow class="product-filter d-flex w-100 mb-3 mt-5">
      <FilterComponent
        :properties="properties"
        @setSecondFilter="setSecondFilter"
        @setFirstFilter="setFirstFilter"
        @toggleOnlyOnline="toggleOnlyOnline"
        @setSearch="setSearch"
        @setBetweenFilter="setBetweenFilter"
      />
      <SellButton :currentCategory="currentCategory"></SellButton>
    </BRow>
    <BRow class="product-list w-100">
      <ProductListTableComponent
        :currentCategory="currentCategory"
        :properties="getTableHeadProperties"
        :onlyOnline="onlyOnline"
        :secondFilter="secondFilter"
        :firstFilter="firstFilter"
        :search="search"
        :betweenFilter="betweenFilter"
      ></ProductListTableComponent>
    </BRow>
  </BRow>
</template>

<script>
import FilterComponent from '@/components/product/product-list/filter/FilterComponent';
import SellButton from '@/components/product/product-list/SellButton';
import ProductListTableComponent from '@/components/product/product-list/product-list-table/ProductListTableComponent';
import { mapActions, mapGetters } from 'vuex';
import * as propertyGetters from '@/store/modules/property/types/getters';
import * as propertyActions from '@/store/modules/property/types/actions';
import Vue from 'vue';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ProductListComponent',
  data: function() {
    return {
      firstFilter: [],
      secondFilter: [],
      onlyOnline: false,
      search: '',
      betweenFilter: {}
    };
  },
  components: { ProductListTableComponent, SellButton, FilterComponent },
  props: {
    currentCategory: Object
  },
  computed: {
    ...mapGetters('Property', {
      properties: propertyGetters.GET_CURRENT_PROPERTIES
    }),

    getTableHeadProperties() {
      return Object.values(this.properties).filter(
        property => property.displayInProductList
      );
    }
  },
  methods: {
    ...mapActions('Property', {
      getCurrentProperties: propertyActions.GET_CURRENT_PROPERTIES
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    setCurrentProperties() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

      this.getCurrentProperties(currentCategoryId);
    },

    setFirstFilter(filterValuesArray) {
      return (this.firstFilter = filterValuesArray);
    },

    setSecondFilter(filterValuesArray) {
      return (this.secondFilter = filterValuesArray);
    },

    toggleOnlyOnline(onlyOnline) {
      this.onlyOnline = onlyOnline;
    },

    setSearch(value) {
      return (this.search = value);
    },

    clearFilters() {
      this.firstFilter = [];
      this.secondFilter = [];
      this.onlyOnline = false;
      this.search = '';
    },

    setBetweenFilter(filterValuesArray) {
      return (this.betweenFilter = {
        betweenMin: filterValuesArray.betweenMin,
        betweenMax: filterValuesArray.betweenMax,
        name: filterValuesArray.name
      });
    }
  },

  async mounted() {
    try {
      await this.setCurrentProperties();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },
  watch: {
    $route: ['setCurrentProperties', 'clearFilters']
  }
};
</script>

<style scoped></style>
