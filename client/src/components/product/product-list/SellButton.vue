<template>
  <BCol cols="3">
    <div class="m-1">
      <div class="d-flex justify-content-end">
        <BButton
          v-if="currentCategory.id"
          :to="{
            name: 'Trade',
            params: { categoryId: this.currentCategory.id }
          }"
          class="h-auto bg-white border rounded-sm text-primary font-weight-bold pr-3 pl-3"
        >
          {{ currentCategory.sellButtonName }}
        </BButton>
      </div>
    </div>
  </BCol>
</template>

<script>
export default {
  name: 'SellButton',
  props: {
    currentCategory: {
      id: Number,
      sellButtonName: String
    }
  }
};
</script>

<style scoped></style>
