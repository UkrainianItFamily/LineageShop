<template>
  <BTr variant="warning">
    <BTh
      class="product-description font-weight-normal"
      @click="$emit('getEditProduct', product.id)"
    >
      <span v-if="product.shortDescription">
        {{ product.type.value }}
        {{ product.profession }}
        {{ product.race.value }}
        {{ product.level }}
        {{ product.shortDescription }}
      </span>
      <span v-else>
        {{ product.name }}
        {{ product.subProperty.value }}
        {{ product.rank.value }}
      </span>
    </BTh>
    <BTh v-if="hasAvailability" class="font-weight-normal">
      {{ product.availability }}
    </BTh>
    <BTh class="font-weight-bold text-md-right">
      {{ product.price }}
      <span class="ml-2">₽</span>
    </BTh>
  </BTr>
</template>

<script>
export default {
  name: 'ProductRow',
  props: {
    hasAvailability: Boolean,
    product: {
      description: String,
      price: Number,
      availability: Number
    }
  }
};
</script>

<style scoped>
.product-description {
  cursor: pointer;
}
</style>
