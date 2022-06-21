<template>
  <BContainer>
    <CategoryComponent :currentCategory="currentCategory"></CategoryComponent>
    <ProductListComponent
      :currentCategory="currentCategory"
    ></ProductListComponent>
  </BContainer>
</template>

<script>
import Vue from 'vue';
import CategoryComponent from '@/components/category/CategoryComponent';
import ProductListComponent from '@/components/product/product-list/ProductListComponent';
import { mapActions, mapGetters } from 'vuex';
import * as categoryGetters from '@/store/modules/category/types/getters';
import * as categoryActions from '@/store/modules/category/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
export default {
  name: 'Index',
  components: { ProductListComponent, CategoryComponent },
  computed: {
    ...mapGetters('Category', {
      currentCategory: categoryGetters.GET_CURRENT_CATEGORY
    })
  },
  methods: {
    ...mapActions('Category', {
      getCurrentCategory: categoryActions.GET_CURRENT_CATEGORY
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    setCurrentCategory() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);
      this.getCurrentCategory(currentCategoryId);
    }
  },
  async mounted() {
    try {
      await this.setCurrentCategory();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },
  watch: {
    $route: 'setCurrentCategory'
  }
};
</script>
