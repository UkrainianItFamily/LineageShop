<template>
  <BRow class="bg-white rounded-lg w-100 p-3 mb-3">
    <RouterLink
      :to="{ name: 'CategoryOpened', params: { categoryId: category.id } }"
      class="text-primary font-weight-bold text-decoration-none fa-2x"
      >{{ category.name }} Lineage 2 Classic (RU)</RouterLink
    >
    <BTableSimple hover class="mt-3">
      <BThead>
        <BTr>
          <BTh>Описание</BTh>
          <BTh v-if="category.hasAvailability" class="text-md-right"
            >Наличие</BTh
          >
          <BTh class="text-md-right">Цена</BTh>
        </BTr>
      </BThead>
      <BTbody>
        <ProductRow
          v-for="product in category.userProducts"
          :key="product.id"
          :product="product"
          :hasAvailability="category.hasAvailability"
        >
        </ProductRow>
      </BTbody>
    </BTableSimple>
  </BRow>
</template>

<script>
import ProductRow from '@/components/user-profile/user-offer/ProductRow';

export default {
  name: 'UserOffersByCategory',
  components: {
    ProductRow
  },
  props: {
    category: {
      id: Number,
      name: String,
      userProducts: Object,
      hasAvailability: Boolean
    }
  }
};
</script>

<style scoped></style>
