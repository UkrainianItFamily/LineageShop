<template>
  <div>
    <BCol md="8" class="category-description">
      <div class="category-description-title">
        {{ currentCategory.name }}
      </div>
      <div class="description text-secondary">
        {{ currentCategory.description }}
      </div>
    </BCol>
  </div>
</template>

<script>
export default {
  name: 'CategoryDescriptionComponent',
  props: {
    currentCategory: {
      name: String,
      description: String
    }
  }
};
</script>

<style scoped></style>
