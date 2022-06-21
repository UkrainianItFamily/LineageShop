<template>
  <RouterLink
    v-if="category.id"
    :to="{ name: 'CategoryOpened', params: { categoryId: category.id } }"
    :class="{ active: this.getCurrentCategoryId(category.id) }"
    class="category rounded-circle position-relative d-block mr-3"
  >
    <div class="inner-block position-absolute">
      <div class="category-name">{{ category.name }}</div>
      <div class="category-count">{{ category.productsCount }}</div>
    </div>
  </RouterLink>
</template>

<script>
import Vue from 'vue';

export default {
  name: 'Category',
  props: {
    category: {
      id: Number,
      name: String,
      productsCount: Number
    }
  },
  methods: {
    getCurrentCategoryId(catId) {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

      return currentCategoryId === catId;
    }
  }
};
</script>

<style scoped>
.category:nth-child(1n) {
  width: 110px;
  height: 110px;
}
.category:nth-child(2n) {
  width: 127px;
  height: 127px;
}
.category:nth-child(3n) {
  width: 140px;
  height: 140px;
}
.inner-block {
  text-align: center;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.category-name {
  font-weight: 700;
}
.category {
  background-color: #f5f5f5;
}
.category.active {
  background: #222222 !important;
}
.category.active > .inner-block {
  color: #ffffff;
}

@media (max-width: 991px) {
  .category {
    margin-bottom: 2%;
    border-radius: 20px !important;
    height: auto !important;
    padding: 20px 4% !important;
  }
  .inner-block {
    position: static;
    display: flex;
  }
}
</style>
