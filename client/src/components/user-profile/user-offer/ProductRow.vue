<template>
  <BTr>
    <BTd>
      <RouterLink
        :to="{ name: 'ProductDetails', params: { id: product.id } }"
        class="text-decoration-none text-dark"
      >
        {{ product.description }}
      </RouterLink>
    </BTd>
    <BTd v-if="hasAvailability" class="text-md-right">{{
      product.availability
    }}</BTd>
    <BTd class="text-md-right font-weight-bold"
      >{{ product.price }} <span>₽</span></BTd
    >
  </BTr>
</template>

<script>
export default {
  name: 'ProductRow',
  props: {
    product: {
      id: Number,
      name: String,
      categoryId: Number,
      description: String,
      price: Number,
      availability: Number,
      user: Object,
      propertiesValue: Object
    },
    hasAvailability: Boolean
  }
};
</script>

<style scoped></style>
