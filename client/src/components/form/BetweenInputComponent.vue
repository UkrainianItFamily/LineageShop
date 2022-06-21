<template>
  <div class="d-flex align-items-center">
    <span class="text-secondary unique-font">{{ name }}</span>
    <BFormInput
      size="sm"
      placeholder="от"
      class="level-input ml-2 shadow-none"
      v-model="inputValue.betweenMin"
      @input="$emit('sendBetweenValues', inputValue)"
    ></BFormInput>
    <BFormInput
      size="sm"
      placeholder="до"
      class="level-input ml-2 shadow-none"
      v-model="inputValue.betweenMax"
      @input="$emit('sendBetweenValues', inputValue)"
    ></BFormInput>
  </div>
</template>

<script>
export default {
  name: 'BetweenInputComponent',
  data: function() {
    return {
      betweenMin: null,
      inputValue: {
        betweenMin: null,
        betweenMax: null,
        name: this.inputName
      }
    };
  },
  props: {
    id: Number,
    name: String,
    inputName: String
  }
};
</script>

<style scoped>
.level-input {
  width: 50px;
}
</style>
