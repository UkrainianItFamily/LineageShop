<template>
  <BRow class="mt-4 position-relative">
    <BCol cols="6">
      <div>
        <h5 class="unique-font">
          Заплачу
        </h5>
        <div>
          <BFormInput
            :value="getOrderPrice"
            readonly
            class="bg-light shadow-none"
          ></BFormInput>
        </div>
      </div>
    </BCol>
    <BCol cols="6">
      <div>
        <h5 class="unique-font">Получу</h5>
        <div>
          <BFormInput
            v-model="quantity"
            @input="getQuantity"
            class="shadow-none"
            type="number"
          ></BFormInput>
        </div>
      </div>
    </BCol>
    <span class="exchange-alt-icon position-absolute">
      <FontAwesomeIcon :icon="['fas', 'exchange-alt']" size="1x" />
    </span>
  </BRow>
</template>

<script>
import _ from 'lodash';

export default {
  name: 'QuantityField',
  props: {
    productPrice: Number
  },
  data() {
    return {
      quantity: null
    };
  },
  computed: {
    getOrderPrice() {
      return _.floor(_.multiply(this.productPrice, this.quantity), 2);
    }
  },
  methods: {
    getQuantity() {
      this.$emit('getQuantity', this.quantity);
    }
  }
};
</script>

<style scoped>
.exchange-alt-icon {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -10%);
}
</style>
