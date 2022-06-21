<template>
  <BModal title="Редактировать предложение" id="edit-product" hide-footer>
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
    <BButton @click="productDelete" class="col-12" variant="danger"
      >Удалить</BButton
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
  name: 'ProductEditModalComponent',
  data: function() {
    return {
      formData: {},
      modalId: 'edit-product'
    };
  },
  props: {
    hasAvailability: Boolean,
    product: Object
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
      updateProduct: productActions.UPDATE_PRODUCT,
      deleteProduct: productActions.DELETE_PRODUCT
    }),

    setCurrentProperties() {
      let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

      this.getCurrentProperties(currentCategoryId);
    },

    formatFormData(value) {
      this.formData[value[1]] = value[0];
    },

    createFormDataForEdit() {
      this.formData = {
        id: this.product.id,
        active: this.product.active,
        categoryId: Vue.getCurrentCategoryId(this.$route),
        race: this.product.race ? this.product.race : null,
        equipment: this.product.equipment ? this.product.equipment : null,
        level: this.product.level ? this.product.level : null,
        profession: this.product.profession ? this.product.profession : null,
        rank: this.product.rank ? this.product.rank : null,
        type: this.product.type ? this.product.type : null,
        property: this.product.property ? this.product.property : null,
        title: this.product.name ? this.product.name : null,
        shortDescription: this.product.shortDescription
          ? this.product.shortDescription
          : null,
        description: this.product.description ? this.product.description : null,
        price: this.product.price ? this.product.price : null,
        availability: this.product.availability
          ? this.product.availability
          : null,
        subProperty: this.product.subProperty ? this.product.subProperty : null
      };
    },
    sendForm() {
      this.updateProduct(this.formData);
      this.$emit('hideModal', this.modalId);
    },
    productDelete() {
      this.deleteProduct(this.product.id);
      this.$emit('hideModal', this.modalId);
    }
  },

  async mounted() {
    try {
      await this.setCurrentProperties();
      await this.createFormDataForEdit();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },
  watch: {
    $route: ['setCurrentProperties'],
    product: ['createFormDataForEdit']
  }
};
</script>

<style scoped></style>
