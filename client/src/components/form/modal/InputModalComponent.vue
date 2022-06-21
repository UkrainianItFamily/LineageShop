<template>
  <BFormGroup class="mb-3">
    <label class="fa-xs text-uppercase">{{ property.name }}</label>
    <div
      class="position-relative d-flex justify-content-end align-items-center"
    >
      <BFormInput
        class="shadow-none"
        v-model="inputValue"
        @input="$emit('sendTargetValue', [inputValue, property.inputName])"
      />
    </div>
  </BFormGroup>
</template>

<script>
export default {
  name: 'SelectComponent',
  data: function() {
    return {
      inputValue: null
    };
  },
  props: {
    property: Object,
    formData: Object
  },
  mounted() {
    this.inputValue = this.formData[this.property.inputName];
  }
};
</script>

<style scoped></style>
