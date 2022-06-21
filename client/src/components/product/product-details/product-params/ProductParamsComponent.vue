<template>
  <section>
    <h1 class="mb-4">{{ title }}</h1>
    <ProductPropertiesListComponent
      :propertiesValues="product.propertiesValue"
      :product="product"
    ></ProductPropertiesListComponent>
    <div class="mb-4">
      <div
        v-if="
          product.description ? product.description : product.shortDescription
        "
      >
        <h5 class="unique-font">Описание</h5>
        <div>
          {{
            product.description ? product.description : product.shortDescription
          }}
        </div>
      </div>
      <div>
        <SelectWalletButton
          @getWalletTypeId="getWalletTypeId"
          :walletTypes="walletTypes"
        ></SelectWalletButton>
        <NicknameField
          @getNickname="getNickname"
          v-if="currentCategory.hasNicknameInOrder"
        ></NicknameField>
        <QuantityField
          @getQuantity="getQuantity"
          v-if="currentCategory.hasAvailability"
          :productPrice="product.price"
        ></QuantityField>
      </div>
    </div>
  </section>
</template>

<script>
import ProductPropertiesListComponent from './ProductPropertiesListComponent';
import SelectWalletButton from '@/components/wallet-type/SelectWalletButton';
import NicknameField from './NicknameField';
import QuantityField from './QuantityField';

export default {
  name: 'ProductParamsComponent',
  components: {
    ProductPropertiesListComponent,
    NicknameField,
    QuantityField,
    SelectWalletButton
  },
  props: {
    title: String,
    currentCategory: {
      hasNickname: Boolean
    },
    product: {
      propertiesValue: Object,
      description: String,
      shortDescription: String
    },
    walletTypes: Object
  },
  methods: {
    getWalletTypeId(walletTypeId) {
      this.$emit('getWalletTypeId', walletTypeId);
    },
    getNickname(nickname) {
      this.$emit('getNickname', nickname);
    },
    getQuantity(quantity) {
      this.$emit('getQuantity', quantity);
    }
  }
};
</script>

<style scoped></style>
