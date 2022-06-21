<template>
  <BTr>
    <BTh class="product-description font-weight-normal">
      <RouterLink
        :to="{ name: 'ProductDetails', params: { id: product.id } }"
        class="text-decoration-none text-dark"
      >
        <span v-if="product.shortDescription">
          {{ product.type.value }} {{ product.profession }}
          {{ product.race.value }} {{ product.level }}
          {{ product.shortDescription }}
        </span>
        <span v-else>
          {{ product.name }} {{ product.subProperty.value }}
          {{ product.rank.value }}
        </span>
      </RouterLink>
    </BTh>
    <BTh class="font-weight-normal">
      <SellerColumn :user="product.user"></SellerColumn>
    </BTh>
    <BTh
      v-if="availableProperties.includes('availability')"
      class="font-weight-normal"
    >
      {{ product.availability }}
    </BTh>
    <BTh class="font-weight-bold text-md-right">
      {{ product.price }}
      <span class="ml-2">₽</span>
    </BTh>
  </BTr>
</template>

<script>
import SellerColumn from '@/components/product/product-list/product-list-table/SellerColumn';
export default {
  name: 'ProductRow',
  components: { SellerColumn },
  props: {
    product: {
      id: Number,
      name: String,
      description: String,
      price: Number,
      availability: Number,
      user: Object,
      propertiesValue: Array
    },
    currentCategory: {
      hasAvailability: Boolean
    },
    properties: Array,
    availableProperties: Array
  },

  methods: {
    findProductPropertyValue(propertyId) {
      let propertyValue = Object.values(this.product.propertiesValue).find(
        propertyValue => propertyValue.propertyId === propertyId
      );

      if (propertyValue?.value) {
        return propertyValue.value;
      } else if (propertyValue?.valueId?.value) {
        return propertyValue.valueId.value;
      }

      return '-';
    }
  }
};
</script>

<style scoped>
.product-description {
  width: 60%;
}
</style>
