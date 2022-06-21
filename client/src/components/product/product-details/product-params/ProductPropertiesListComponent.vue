<template>
  <BRow>
    <template v-if="product.name">
      <BCol cols="6">
        <ProductPropertiesItemComponent
          name="Наименование"
          :property="product.name"
        />
      </BCol>
    </template>
    <BCol cols="6">
      <ProductPropertiesItemComponent name="Цена" :property="product.price" />
    </BCol>
    <template v-if="product.rank">
      <BCol cols="6" v-if="product.rank.value">
        <ProductPropertiesItemComponent
          name="Ранг"
          :property="product.rank.value"
        />
      </BCol>
    </template>
    <template v-if="product.subProperty">
      <BCol cols="6" v-if="product.subProperty.value">
        <ProductPropertiesItemComponent
          name="Тип"
          :property="product.subProperty.value"
        />
      </BCol>
    </template>
    <BCol cols="6" v-if="product.availability">
      <ProductPropertiesItemComponent
        name="Доступное количество"
        :property="product.availability"
      />
    </BCol>
    <template v-if="product.equipment">
      <BCol cols="6" v-if="product.equipment.value">
        <ProductPropertiesItemComponent
          name="Экипировка"
          :property="product.equipment.value"
        />
      </BCol>
    </template>
    <BCol cols="6" v-if="product.profession">
      <ProductPropertiesItemComponent
        name="Профессия"
        :property="product.profession"
      />
    </BCol>
    <BCol cols="6" v-if="product.level">
      <ProductPropertiesItemComponent
        name="Уровень"
        :property="product.level"
      />
    </BCol>
    <template v-if="product.type">
      <BCol cols="6" v-if="product.type.value">
        <ProductPropertiesItemComponent
          name="Тип"
          :property="product.type.value"
        />
      </BCol>
    </template>
  </BRow>
</template>

<script>
import _ from 'lodash';
import ProductPropertiesItemComponent from './ProductPropertiesItemComponent';

export default {
  name: 'ProductPropertiesListComponent',
  components: {
    ProductPropertiesItemComponent
  },
  props: {
    propertiesValues: Object,
    product: Object
  },
  computed: {
    getArraysProperties() {
      return _.chunk(_.values(this.propertiesValues), 2);
    }
  }
};
</script>

<style scoped></style>
