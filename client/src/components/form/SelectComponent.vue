<template>
  <div>
    <BFormSelect
      v-model="checked"
      :options="getOptions"
      size="sm"
      class="font-weight-bold shadow-none"
      @input="$emit('sendTargetValue', [checked, inputName])"
    >
      <BFormSelectOption value="null" v-if="!formData">
        {{ name }}
      </BFormSelectOption>
    </BFormSelect>
    <CategoryPropertyComponent
      class="mt-3"
      v-for="property in getOptionsWithChild"
      :key="property.id"
      :property="property"
      v-show="checked === property.parentDefaultValueId"
      @formatFormData="formatFormData"
      :formData="formData"
    />
  </div>
</template>

<script>
export default {
  name: 'SelectComponent',
  data: function() {
    return {
      checked: null
    };
  },
  props: {
    id: Number,
    name: String,
    options: Object,
    inputName: String,
    subProperties: Object,
    formData: Object
  },
  computed: {
    getOptions() {
      let options = Object.values(this.options);

      if (!this.checked) {
        options.unshift({
          value: null,
          text: this.name
        });
      }

      return options;
    },
    getOptionsWithChild() {
      let result = [];

      if (this.subProperties) {
        Object.values(this.subProperties).map(function(option) {
          if (option.propertyDefaultValues) {
            result.push(option);
          }
        });
      }
      return result;
    }
  },
  methods: {
    formatFormData(value) {
      return this.$emit('sendTargetValue', value);
    }
  },
  created() {
    try {
      this.formData[this.inputName]
        ? (this.checked = this.formData[this.inputName])
        : (this.checked = null);
    } catch {
      this.checked = null;
    }
  }
};
</script>

<style scoped></style>
