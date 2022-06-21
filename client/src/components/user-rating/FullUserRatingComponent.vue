<template>
  <div>
    <BRow class="text-secondary text-uppercase font-weight-bold fa-xs"
      >Рейтинг продавца</BRow
    >
    <BRow class="d-flex justify-content-start">
      <div class="mr-5 ml-3">
        <BRow>
          <span class="font-weight-bold fa-4x pt-1">{{
            getUserRatingAverage
          }}</span>
          <span class="font-weight-bold pt-5"> из 5</span>
        </BRow>
      </div>
      <div class="pt-3">
        <BRow
          v-for="(userRating, index) in getUserRatingInPercentage"
          :key="index"
          class="rating-star-item justify-content-end mb-1"
        >
          <div
            class="rating-star-count seller-reviews-cool d-flex align-items-center fa-xs mr-1"
          >
            <FontAwesomeIcon
              v-for="n in parseInt(index)"
              :key="n"
              :icon="['fas', 'star']"
              size="xs"
            />
          </div>
          <div class="rating-star-progress">
            <div :style="`width: ${userRating}%`"></div>
          </div>
        </BRow>
      </div>
      <div class="ml-4 mt-3">
        <BDropdown variant="white" :toggle-class="'shadow-none w-100'">
          <template #button-content>
            <BFormRating
              v-if="selectedRating"
              v-model="getSelectedRating"
              class="seller-reviews-cool"
              variant="relative"
              no-border
              readonly
              size="xs"
            ></BFormRating>
            <div v-else>{{ getSelectedRating }}</div>
          </template>
          <BDropdownItem @click="setSelectedRating(null)">
            Все отзывы
          </BDropdownItem>
          <BDropdownItem v-for="n in 5" :key="n" @click="setSelectedRating(n)">
            <BFormRating
              :value="n"
              class="seller-reviews-cool"
              variant="transparent"
              no-border
              readonly
              size="xs"
            ></BFormRating
          ></BDropdownItem>
        </BDropdown>
      </div>
    </BRow>
  </div>
</template>

<script>
import Vue from 'vue';

export default {
  name: 'FillUserRatingComponent',
  data() {
    return {
      selectedRating: null
    };
  },
  props: {
    userRatings: Object
  },
  computed: {
    getSelectedRating() {
      return this.selectedRating ? this.selectedRating : 'Все отзывы';
    },
    getCountAllUserRatings() {
      return Vue.getCountAllUserRatings(this.userRatings);
    },
    getUserRatingAverage() {
      return Vue.getUserRatingAverage(
        this.userRatings,
        this.getCountAllUserRatings
      );
    },
    getUserRatingInPercentage() {
      return Vue.getUserRatingInPercentage(
        this.userRatings,
        this.getCountAllUserRatings
      );
    }
  },
  methods: {
    setSelectedRating(numberStars) {
      this.selectedRating = numberStars;
    }
  }
};
</script>

<style scoped></style>
