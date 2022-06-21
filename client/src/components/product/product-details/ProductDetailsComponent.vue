<template>
  <div>
    <BackgroundImageComponent></BackgroundImageComponent>
    <BRow>
      <BCol md="2" sm="3">
        <BackLinkComponent
          :currentCategory="currentCategory"
        ></BackLinkComponent>
      </BCol>
      <BCol md="5" sm="9">
        <ProductParamsComponent
          :title="'Оформление заказа'"
          :product="product"
          :walletTypes="walletTypes"
          :currentCategory="currentCategory"
          @getWalletTypeId="getWalletTypeId"
          @getNickname="getNickname"
          @getQuantity="getQuantity"
        ></ProductParamsComponent>
        <AddOrderButton
          v-if="product.user"
          :productId="product.id"
          :productAvailability="product.availability"
          :userId="product.user.id"
          :paramsOrderData="paramsOrderData"
        ></AddOrderButton>
        <hr class="hidden-xs mt-5 mb-5" />
        <RatingAndReviewsComponent
          :userRatings="userRatings"
        ></RatingAndReviewsComponent>
      </BCol>
      <BCol md="5">
        <ChatComponent
          :userRatings="userRatings"
          :user="product.user"
        ></ChatComponent>
      </BCol>
    </BRow>
  </div>
</template>

<script>
import BackLinkComponent from '@/components/product/product-details/BackLinkComponent';
import ProductParamsComponent from '@/components/product/product-details/product-params/ProductParamsComponent';
import RatingAndReviewsComponent from '@/components/user-rating/RatingAndReviewsComponent';
import BackgroundImageComponent from '@/components/main-layout-blocks/header/BackgroundImageComponent';
import ChatComponent from './chat/ChatComponent';
import AddOrderButton from '@/components/my-order/AddOrderButton';
import * as authGetters from '@/store/modules/auth/types/getters';
import * as userRatingGetters from '@/store/modules/user-rating/types/getters';
import * as productGetters from '@/store/modules/product/types/getters';
import * as walletTypesGetters from '@/store/modules/wallet-type/types/getters';
import * as categoryGetters from '@/store/modules/category/types/getters';
import * as productActions from '@/store/modules/product/types/actions';
import * as userRatingActions from '@/store/modules/user-rating/types/actions';
import * as categoryActions from '@/store/modules/category/types/actions';
import * as walletTypesActions from '@/store/modules/wallet-type/types/getters';
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as messageActions from '@/store/modules/message/types/actions';
import * as chatGetters from '@/store/modules/chat/types/getters';
import * as chatActions from '@/store/modules/chat/types/actions';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'ProductDetailsComponent',
  components: {
    ProductParamsComponent,
    ChatComponent,
    RatingAndReviewsComponent,
    BackgroundImageComponent,
    BackLinkComponent,
    AddOrderButton
  },
  data() {
    return {
      paramsOrderData: {
        nickname: '',
        walletTypeId: null,
        quantity: null
      }
    };
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    }),
    ...mapGetters('UserRating', {
      userRatings: userRatingGetters.GET_USER_RATINGS_BY_USER
    }),
    ...mapGetters('Product', {
      product: productGetters.GET_PRODUCT
    }),
    ...mapGetters('WalletType', {
      walletTypes: walletTypesGetters.GET_WALLET_TYPES
    }),
    ...mapGetters('Category', {
      currentCategory: categoryGetters.GET_CURRENT_CATEGORY
    }),
    ...mapGetters('chat', {
      chat: chatGetters.GET_CHAT
    })
  },
  methods: {
    ...mapActions('Product', {
      getProduct: productActions.GET_PRODUCT
    }),
    ...mapActions('UserRating', {
      getUserRatings: userRatingActions.GET_USER_RATINGS_BY_USER
    }),
    ...mapActions('Category', {
      getCurrentCategory: categoryActions.GET_CURRENT_CATEGORY
    }),
    ...mapActions('WalletType', {
      getWalletTypes: walletTypesActions.GET_WALLET_TYPES
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    ...mapActions('Message', {
      getMessageByChatId: messageActions.GET_MESSAGES_BY_CHAT_ID
    }),
    ...mapActions('chat', {
      getChatByUserId: chatActions.GET_CHAT_BY_USER_ID
    }),
    getWalletTypeId(walletTypeId) {
      this.paramsOrderData.walletTypeId = walletTypeId;
    },
    getNickname(nickname) {
      this.paramsOrderData.nickname = nickname;
    },
    getQuantity(quantity) {
      this.paramsOrderData.quantity = quantity;
    },
    async productDetailsInitialize() {
      try {
        await this.getProduct(this.$route.params.id);
        await this.getChatByUserId(this.product.user.id);
        if (this.chat.id) {
          await this.getMessageByChatId(this.chat.id);
        }
        await this.getUserRatings(this.product.user.id);
        await this.getCurrentCategory(this.product.categoryId);
        await this.getWalletTypes();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  },
  async mounted() {
    await this.productDetailsInitialize();
  },
  watch: {
    $route: 'productDetailsInitialize'
  }
};
</script>

<style scoped></style>
