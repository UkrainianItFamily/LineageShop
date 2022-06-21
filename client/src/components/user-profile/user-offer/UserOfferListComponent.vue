<template>
  <div>
    <BRow class="text-secondary text-uppercase font-weight-bold fa-xs mb-2">
      Предложения
    </BRow>
    <UserOffersByCategory
      v-for="category in categories"
      :key="category.id"
      :category="category"
    ></UserOffersByCategory>
  </div>
</template>

<script>
import UserOffersByCategory from '@/components/user-profile/user-offer/UserOffersByCategory';
import * as categoriesGetters from '@/store/modules/category/types/getters';
import * as categoriesActions from '@/store/modules/category/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'UserOfferListComponent',
  components: {
    UserOffersByCategory
  },
  computed: {
    ...mapGetters('Category', {
      categories: categoriesGetters.GET_CATEGORIES_WITH_PRODUCTS_FOR_USER
    }),
    getUserId() {
      return Number(_.get(this.$route, 'params.id', null));
    }
  },
  methods: {
    ...mapActions('Category', {
      getCategories: categoriesActions.GET_CATEGORIES_WITH_PRODUCTS_FOR_USER
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    setCategoriesByUserId() {
      this.getCategories(this.getUserId);
    }
  },
  async mounted() {
    try {
      await this.setCategoriesByUserId();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
