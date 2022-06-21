<template>
  <div class="param-item mb-4">
    <h5 class="param-title unique-font">
      {{ name }}
    </h5>
    <div class="param-content font-weight-bold">
      {{ property }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductPropertiesItemComponent',
  props: {
    property: {
      type: [Number, String]
    },
    name: String
  }
};
</script>

<style scoped></style>
