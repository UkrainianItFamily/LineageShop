<template>
  <div class="filter-item m-1">
    <SelectComponent
      :name="property.name"
      :id="property.id"
      :options="property.propertyDefaultValues"
      :inputName="property.inputName"
      v-model="checked"
      v-show="checkedProperties.includes(property.parentDefaultValueId)"
      @sendTargetValue="returnCheckedValue"
    ></SelectComponent>
  </div>
</template>

<script>
import SelectComponent from '@/components/form/SelectComponent';
export default {
  name: 'CategoryPropertiesList',
  components: { SelectComponent },
  data: function() {
    return {
      checked: null
    };
  },
  props: {
    property: Object,
    checkedProperties: Array
  },
  methods: {
    returnCheckedValue(checkedValue) {
      return this.$emit('returnCheckedValue', checkedValue);
    }
  },
  mounted() {
    this.$emit(
      'returnParentDefaultValueId',
      this.property.parentDefaultValueId
    );
  }
};
</script>

<style scoped></style>
