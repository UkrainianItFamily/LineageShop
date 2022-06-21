<template>
  <BCol cols="9">
    <BNavbar toggleable="md" variant="white">
      <BNavbarBrand class="d-md-none font-weight-bold" href="#"
        >Фильтры</BNavbarBrand
      >
      <BNavbarToggle target="nav-collapse-filter"></BNavbarToggle>
      <BCollapse id="nav-collapse-filter" is-nav
        ><BNavForm class="d-flex flex-wrap">
          <BRow>
            <div class="filter-item m-1">
              <BFormGroup
                label="Только продавцы онлайн"
                label-size="sm"
                label-for="filter-online-sellers"
                content-cols="2"
                class="only-online d-flex align-items-center bg-white border rounded-sm text-secondary font-weight-bold pl-2 pr-2 m-0"
              >
                <BFormCheckbox
                  id="filter-online-sellers"
                  name="check-button"
                  size="sm"
                  switch
                  class="shadow-none"
                  v-model="onlyOnline"
                  @change="$emit('toggleOnlyOnline', onlyOnline)"
                />
              </BFormGroup>
            </div>
            <CategoryPropertiesList
              v-for="property in properties"
              :key="property.id"
              :property="property"
              @returnCheckedValue="setShowSubProperty"
              @returnBetweenValues="setBetweenFilter"
            ></CategoryPropertiesList>
            <CategorySubPropertiesList
              v-for="property in subProperties"
              :key="property.id"
              :property="property"
              :checkedProperties="checkedProperties"
              @returnParentDefaultValueId="setParentPropertiesIdArray"
              @returnCheckedValue="setSecondFilter"
            ></CategorySubPropertiesList>
            <div class="filter-item m-1">
              <div
                class="d-flex align-items-center justify-content-end position-relative"
              >
                <BFormInput
                  placeholder="Поиск по описанию"
                  size="sm"
                  class="shadow-none"
                  v-model="inputSearch"
                  @input="$emit('setSearch', inputSearch)"
                >
                </BFormInput>
                <span class="text-secondary position-absolute pr-2">
                  <FontAwesomeIcon :icon="['fas', 'search']" />
                </span>
              </div>
            </div>
          </BRow>
        </BNavForm>
      </BCollapse>
    </BNavbar>
  </BCol>
</template>

<script>
import CategoryPropertiesList from '@/components/product/product-list/filter/CategoryPropertiesList';
import CategorySubPropertiesList from '@/components/product/product-list/filter/CategorySubPropertiesList';
export default {
  name: 'FilterComponent',
  components: { CategoryPropertiesList, CategorySubPropertiesList },
  data: function() {
    return {
      subProperties: [],
      checkedProperties: [],
      parentPropertiesIdArray: [],
      inputSearch: '',
      onlyOnline: false
    };
  },
  props: {
    properties: Object
  },
  methods: {
    getSubProperties() {
      return Object.values(this.properties).map(property => {
        if (property.subProperties) {
          this.subProperties = property.subProperties;
        }
      });
    },

    setShowSubProperty(checkedValueArray) {
      let checkedId = checkedValueArray[0];
      let inputName = checkedValueArray[1];
      if (inputName === 'property') {
        this.parentPropertiesIdArray.map(propertyId => {
          delete this.checkedProperties[
            this.checkedProperties.indexOf(propertyId)
          ];
        });
      }
      this.checkedProperties.push(checkedId);

      return this.$emit('setFirstFilter', checkedValueArray);
    },

    setSecondFilter(checkedValueArray) {
      return this.$emit('setSecondFilter', checkedValueArray);
    },

    setParentPropertiesIdArray(id) {
      return this.parentPropertiesIdArray.push(id);
    },

    clearCheckedProperties() {
      if (this.checkedProperties.length > 0) {
        return (this.checkedProperties = []);
      }
    },

    setBetweenFilter(values) {
      this.$emit('setBetweenFilter', values);
    }
  },

  updated() {
    this.getSubProperties();
  },
  watch: {
    $route: ['clearCheckedProperties']
  }
};
</script>

<style scoped>
.only-online > label {
  padding-bottom: 0.1rem;
}
.custom-switch.b-custom-control-sm .custom-control-label::before {
  box-shadow: none;
}
</style>
