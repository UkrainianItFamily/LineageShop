<template>
  <BContainer>
    <BackgroundImageComponent></BackgroundImageComponent>
    <BRow align-h="between">
      <BCol md="2" sm="3">
        <div class="back-link">
          <RouterLink
            v-if="this.$route.params.categoryId"
            :to="{
              name: 'CategoryOpened',
              params: { id: this.$route.params.categoryId }
            }"
            class="d-flex align-items-center position-relative text-white pl-3"
          >
            <FontAwesomeIcon
              :icon="['fas', 'chevron-left']"
              size="1x"
              class="back-link-icon"
            />
            <span class="back-link-inside font-weight-bold">
              {{ currentCategory.name }} Lineage 2 (RU)</span
            >
          </RouterLink>
        </div>
      </BCol>
      <BCol md="10" sm="9">
        <div class="page-content">
          <BRow class="mb-3">
            <BCol md="5" ld="6">
              <h1 class="page-header page-header-no-hr ">
                Ваши предложения
              </h1>
            </BCol>
            <BCol md="7" ld="6">
              <BRow class="d-flex justify-content-end">
                <BCol sm="6">
                  <BButton
                    v-b-modal.add-product
                    variant="primary"
                    class="btn-block js-lot-offer-edit"
                    >Добавить предложение</BButton
                  >
                </BCol>
              </BRow>
            </BCol>
          </BRow>
          <BRow>
            <ProductListComponent
              :hasAvailability="currentCategory.hasAvailability"
              @openEditModal="openEditProductModal"
            ></ProductListComponent>
          </BRow>
        </div>
      </BCol>
    </BRow>
    <ProductAddModalComponent
      :hasAvailability="currentCategory.hasAvailability"
      @hideModal="hideModal"
    ></ProductAddModalComponent>
    <ProductEditModalComponent
      :hasAvailability="currentCategory.hasAvailability"
      :v-modal="product"
      :product="productForEdit"
      @hideModal="hideModal"
    />
  </BContainer>
</template>

<script>
import BackgroundImageComponent from '@/components/main-layout-blocks/header/BackgroundImageComponent';
import ProductListComponent from '@/components/product/product-list-by-user/ProductListTableComponent';
import ProductAddModalComponent from '@/components/form/modal/ProductAddModalComponent';
import * as categoryActions from '@/store/modules/category/types/actions';
import * as categoryGetters from '@/store/modules/category/types/getters';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapGetters, mapActions } from 'vuex';
import Vue from 'vue';
import ProductEditModalComponent from '../components/form/modal/ProductEditModalComponent';
import * as productActions from '@/store/modules/product/types/actions';
import * as productGetters from '@/store/modules/product/types/getters';

export default {
  name: 'TradeItem',
  data: function() {
    return {
      product: null
    };
  },
  components: {
    ProductEditModalComponent,
    BackgroundImageComponent,
    ProductListComponent,
    ProductAddModalComponent
  },
  computed: {
    ...mapGetters('Category', {
      currentCategory: categoryGetters.GET_CURRENT_CATEGORY
    }),
    ...mapGetters('Product', {
      productForEdit: productGetters.GET_PRODUCT
    })
  },
  methods: {
    ...mapActions('Category', {
      getCurrentCategory: categoryActions.GET_CURRENT_CATEGORY
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    ...mapActions('Product', {
      getProduct: productActions.GET_PRODUCT
    }),
    forceRenderEditModal() {
      ProductEditModalComponent.componentKey += 1;
    },
    async openEditProductModal(id) {
      this.product = await this.getProduct(id);
      this.$bvModal.show('edit-product');
    },
    hideModal(modalId) {
      this.$bvModal.hide(modalId);
    }
  },
  async mounted() {
    let currentCategoryId = Vue.getCurrentCategoryId(this.$route);

    try {
      await this.getCurrentCategory(currentCategoryId);
    } catch (error) {
      this.setErrorNotification(error);
    }
  },
  watch: {
    openEditModal: ['forceRenderEditModal']
  }
};
</script>

<style scoped>
.page-header {
  font-size: 30px;
  line-height: 1;
  font-weight: 1000;
}
</style>
