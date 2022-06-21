<template>
  <div class="filter-item m-1">
    <SelectComponent
      v-if="
        $getConst('PROPERTY_TYPE').SELECT === property.type && property.sortable
      "
      :name="property.name"
      :id="property.id"
      :inputName="property.inputName"
      :options="property.propertyDefaultValues"
      @sendTargetValue="returnChecked"
    ></SelectComponent>
    <BetweenInputComponent
      v-if="
        $getConst('PROPERTY_TYPE').BETWEEN_INPUT === property.type &&
          property.sortable
      "
      :name="property.name"
      :id="property.id"
      :inputName="property.inputName"
      @sendBetweenValues="returnBetweenValues"
    ></BetweenInputComponent>
  </div>
</template>

<script>
import SelectComponent from '@/components/form/SelectComponent';
import BetweenInputComponent from '@/components/form/BetweenInputComponent';
export default {
  name: 'CategoryPropertiesList',
  components: { BetweenInputComponent, SelectComponent },
  data: function() {
    return {
      checked: null
    };
  },
  props: {
    property: Object
  },
  methods: {
    returnChecked(checkedValue) {
      this.$emit('returnCheckedValue', checkedValue);
    },

    returnBetweenValues(checkedValue) {
      this.$emit('returnBetweenValues', checkedValue);
    }
  }
};
</script>

<style scoped></style>
