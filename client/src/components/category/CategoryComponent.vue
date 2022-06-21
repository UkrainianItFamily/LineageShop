<template>
  <div>
    <CategoryDescriptionComponent
      :currentCategory="currentCategory"
    ></CategoryDescriptionComponent>
    <CategoriesListComponent></CategoriesListComponent>
  </div>
</template>

<script>
import CategoryDescriptionComponent from '@/components/category/CategoryDescriptionComponent';
import CategoriesListComponent from '@/components/category/categories-list/CategoriesListComponent';
export default {
  name: 'CategoryComponent',
  components: { CategoriesListComponent, CategoryDescriptionComponent },
  props: {
    currentCategory: Object
  }
};
</script>

<style scoped></style>
