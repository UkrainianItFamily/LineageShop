<template>
  <div class="d-flex justify-content-center">
    <div class="text-center">
      <div class="mb-3">
        <BFormRating
          v-model="getUserRatingAverage"
          class="mb-2 shadow-none seller-reviews-cool"
          no-border
          readonly
          size="xs"
        ></BFormRating>
      </div>
      <a href="#reviews-list"> {{ getCountAllUserRatings }} отзывов </a>
      <div class="text-secondary mt-2">
        Напишите продавцу
        <br />
        перед оплатой
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';

export default {
  name: 'ChatUserSellerRatingComponent',
  props: {
    userRatings: Object
  },
  computed: {
    getCountAllUserRatings() {
      return Vue.getCountAllUserRatings(this.userRatings);
    },
    getUserRatingAverage() {
      return Vue.getUserRatingAverage(
        this.userRatings,
        this.getCountAllUserRatings
      );
    }
  }
};
</script>

<style scoped></style>
