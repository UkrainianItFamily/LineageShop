<template>
  <div class="category-list d-flex flex-wrap align-items-center">
    <template v-for="category in categories">
      <Category :key="category.id" :category="category"></Category>
    </template>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as categoryGetters from '@/store/modules/category/types/getters';
import * as categoryActions from '@/store/modules/category/types/actions';
import Category from '@/components/category/categories-list/Category';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'CategoriesListComponent',
  components: { Category },
  computed: {
    ...mapGetters('Category', {
      categories: categoryGetters.GET_CATEGORIES
    })
  },
  methods: {
    ...mapActions('Category', {
      getCategories: categoryActions.GET_CATEGORIES
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    })
  },
  async mounted() {
    try {
      await this.getCategories();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
