<template>
  <div>
    <SelectModalComponent
      v-if="$getConst('PROPERTY_TYPE').SELECT === property.type"
      :property="property"
      :formData="formData"
      @sendTargetValue="sendTargetValue"
    ></SelectModalComponent>
    <InputModalComponent
      v-if="$getConst('PROPERTY_TYPE').BETWEEN_INPUT === property.type"
      :property="property"
      :formData="formData"
      @sendTargetValue="sendTargetValue"
    ></InputModalComponent>
    <TextAreaModalComponent
      v-if="$getConst('PROPERTY_TYPE').TEXT_AREA === property.type"
      :property="property"
      :formData="formData"
      @sendTargetValue="sendTargetValue"
    />
  </div>
</template>

<script>
import SelectModalComponent from '@/components/form/modal/SelectModalComponent';
import InputModalComponent from '@/components/form/modal/InputModalComponent';
import TextAreaModalComponent from '@/components/form/modal/TextAreaModalComponent';

export default {
  name: 'CategoryPropertyComponent',
  components: {
    TextAreaModalComponent,
    SelectModalComponent,
    InputModalComponent
  },
  props: {
    property: Object,
    formData: Object
  },
  methods: {
    sendTargetValue(value) {
      return this.$emit('formatFormData', value);
    }
  }
};
</script>

<style scoped></style>
