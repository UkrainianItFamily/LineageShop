<template>
  <div>
    <BContainer>
      <div
        class="profile-cover-container position-relative rounded-circle overflow-hidden"
      >
        <img
          src="@/assets/profile-header.jpg"
          class="profile-cover-img w-100"
          alt=""
        />
      </div>
      <BRow class="avatar position-relative">
        <AvatarComponent
          :userPhoto="user.userPhoto"
          :width="160"
          :height="160"
        ></AvatarComponent>
      </BRow>
      <BRow class="mt-3">
        <span class="fa-2x font-weight-bold mr-3">{{ user.login }}</span>
        <span
          v-if="user.onlineStatus"
          :class="`text-${user.onlineStatus.variant} font-weight-bold pt-3`"
          >{{ user.onlineStatus.text }}</span
        >
      </BRow>
      <BRow class="mt-3">
        <BCol cols="12" md="3" xs="6">
          <div class="text-secondary text-uppercase font-weight-bold fa-xs">
            Дата регистрации
          </div>
          <div class="w-50 mt-2">
            <div>
              {{ user.createdAt | moment('DD MMMM, H:MM') }}
            </div>
            <div>
              {{ user.createdAt | moment('from') }}
            </div>
          </div>
        </BCol>
        <BCol cols="12" md="9" xs="6">
          <UserRatingComponent :userRatings="userRatings"></UserRatingComponent>
        </BCol>
      </BRow>
    </BContainer>
    <div class="mt-3 pt-5 pb-5">
      <BContainer>
        <BRow>
          <BCol cols="12" md="7">
            <BRow>
              <BCol cols="12">
                <UserOfferListComponent></UserOfferListComponent>
                <BRow
                  class="text-secondary text-uppercase font-weight-bold fa-xs mb-2"
                >
                  Отзывы
                </BRow>
                <BRow class="bg-white rounded-lg w-100 p-3 mb-3">
                  <RatingAndReviewsComponent
                    :userRatings="userRatings"
                  ></RatingAndReviewsComponent>
                </BRow>
              </BCol>
            </BRow>
          </BCol>
          <BCol cols="12" md="5">
            <ChatComponent
              v-if="user"
              :userRatings="userRatings"
              :user="user"
            ></ChatComponent>
          </BCol>
        </BRow>
      </BContainer>
    </div>
  </div>
</template>

<script>
import UserOfferListComponent from '@/components/user-profile/user-offer/UserOfferListComponent';
import UserRatingComponent from '@/components/user-rating/UserRatingComponent';
import RatingAndReviewsComponent from '@/components/user-rating/RatingAndReviewsComponent';
import ChatComponent from '@/components/product/product-details/chat/ChatComponent';
import AvatarComponent from '@/components/user-profile/AvatarComponent';
import * as userActions from '@/store/modules/user/types/actions';
import * as userGetters from '@/store/modules/user/types/getters';
import * as userRatingGetters from '@/store/modules/user-rating/types/getters';
import * as userRatingActions from '@/store/modules/user-rating/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as messageActions from '@/store/modules/message/types/actions';
import * as chatGetters from '@/store/modules/chat/types/getters';
import * as chatActions from '@/store/modules/chat/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'UserProfile',
  components: {
    UserOfferListComponent,
    RatingAndReviewsComponent,
    ChatComponent,
    UserRatingComponent,
    AvatarComponent
  },
  computed: {
    ...mapGetters('User', {
      user: userGetters.GET_USER
    }),
    ...mapGetters('UserRating', {
      userRatings: userRatingGetters.GET_USER_RATINGS_BY_USER
    }),
    ...mapGetters('chat', {
      chat: chatGetters.GET_CHAT
    }),
    userId() {
      return Number(_.get(this.$route, 'params.id', null));
    }
  },
  methods: {
    ...mapActions('User', {
      getUser: userActions.GET_USER
    }),
    ...mapActions('UserRating', {
      getUserRatings: userRatingActions.GET_USER_RATINGS_BY_USER
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
    async userProfileInitialize() {
      try {
        await this.getUser(this.userId);
        await this.getChatByUserId(this.userId);
        if (this.chat.id) {
          await this.getMessageByChatId(this.chat.id);
        }
        await this.getUserRatings(this.userId);
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  },
  async mounted() {
    await this.userProfileInitialize();
  },
  watch: {
    $route: 'userProfileInitialize'
  }
};
</script>

<style scoped>
.avatar {
  z-index: 2;
  margin-top: -150px;
}
.profile-cover-container {
  margin-top: -250px;
}
</style>
