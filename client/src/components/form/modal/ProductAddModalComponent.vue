<template>
  <BModal title="Добавить предложение" id="add-product" hide-footer>
    <CategoryPropertyComponent
      v-for="property in properties"
      :key="property.id"
      :property="property"
      :formData="formData"
      @formatFormData="formatFormData"
    />
    <div class="mb-3 col-5 p-0">
      <div class="fa-xs text-uppercase mb-2">цена для покупателей</div>
      <BTableSimple borderless>
        <BTbody>
          <BTr>
            <BTd class="fa-xs m-0 p-0">Банковская карта</BTd>
            <BTd class="fa-xs m-0 p-0">2000 ₽</BTd>
          </BTr>
          <BTr>
            <BTd class="fa-xs m-0 p-0">Банковская карта</BTd>
            <BTd class="fa-xs m-0 p-0">2000 ₽</BTd>
          </BTr>
        </BTbody>
      </BTableSimple>
    </div>
    <div class="mb-3">
      <BFormCheckbox
        name="active"
        v-model="formData['active']"
        class="shadow-none"
      >
        Активное
      </BFormCheckbox>
    </div>
    <BButton @click="sendForm()" class="col-12 mb-2" variant="primary"
      >Сохранить</BButton
    >
  </BModal>
</template>

<script>
import CategoryPropertyComponent from '@/components/form/modal/CategoryPropertyComponent';
import { mapActions, mapGetters } from 'vuex';
import * as propertyGetters from '@/store/modules/property/types/getters';
import * as propertyActions from '@/store/modules/property/types/actions';
import * as productActions from '@/store/modules/product/types/actions';
import Vue from 'vue';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ProductAddModalComponent',
  data: function() {
    return {
      formData: {
        active: true,
        categoryId: Vue.getCurrentCategoryId(this.$route),
        availability: this.$getConst('PRODUCT').DEFAULT_AVAILABILITY
      }
    };
  },
  props: {
    hasAvailability: Boolean
  },
  components: {
    CategoryPropertyComponent
  },
  computed: {
    ...mapGetters('Property', {
      properties: propertyGetters.GET_CURRENT_PROPERTIES
    }),

    getTableHeadProperties() {
      return Object.values(this.properties).filter(
        property => property.displayInProductList
      );
    }
  },
  methods: {
    ...mapActions('Property', {
      getCurrentProperties: propertyActions.GET_CURRENT_PROPERTIES
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    ...mapActions('Product', {
      addProduct: productActions.ADD_PRODUCT
    }),

    setCurrentProperties() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

      this.getCurrentProperties(currentCategoryId);
    },

    formatFormData(value) {
      this.formData[value[1]] = value[0];
    },

    async sendForm() {
      await this.addProduct(this.formData);
      await this.$bvModal.hide('add-product');
      this.formData = {
        active: true,
        categoryId: Vue.getCurrentCategoryId(this.$route)
      };
    }
  },

  async mounted() {
    try {
      await this.setCurrentProperties();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },

  watch: {
    $route: ['setCurrentProperties']
  }
};
</script>

<style scoped></style>
