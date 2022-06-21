<template>
  <div>
    <BFormGroup class="mb-3">
      <label class="fa-xs text-uppercase">{{ property.name }}</label>
      <SelectComponent
        :name="property.name"
        :inputName="property.inputName"
        :id="property.id"
        :options="
          property.propertyDefaultValues
            ? property.propertyDefaultValues
            : property.childProperties
        "
        :formData="formData"
        :subProperties="!property.subProperties ? null : property.subProperties"
        @sendTargetValue="sendTargetValue"
      ></SelectComponent>
    </BFormGroup>
  </div>
</template>

<script>
import SelectComponent from '@/components/form/SelectComponent';

export default {
  name: 'SelectModalComponent',
  components: {
    SelectComponent
  },
  props: {
    property: Object,
    formData: Object
  },
  methods: {
    sendTargetValue(value) {
      return this.$emit('sendTargetValue', value);
    }
  }
};
</script>

<style scoped></style>
