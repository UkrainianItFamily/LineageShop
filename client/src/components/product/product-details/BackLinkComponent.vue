<template>
  <div class="back-link mb-3">
    <RouterLink
      v-if="currentCategory.id"
      :to="{
        name: 'CategoryOpened',
        params: { categoryId: currentCategory.id }
      }"
      class="d-flex align-items-center position-relative text-decoration-none text-white pl-3"
    >
      <FontAwesomeIcon
        :icon="['fas', 'chevron-left']"
        size="1x"
        class="back-link-icon"
      />
      <span class="back-link-inside font-weight-bold"
        >{{ currentCategory.name }} Lineage 2 (RU)</span
      >
    </RouterLink>
  </div>
</template>

<script>
export default {
  name: 'BackLinkComponent',
  props: {
    currentCategory: {
      id: Number,
      name: String
    }
  }
};
</script>

<style scoped></style>
