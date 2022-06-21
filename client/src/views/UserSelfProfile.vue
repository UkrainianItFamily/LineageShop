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
          :userPhoto="getLoggedUser.userPhoto"
          :width="160"
          :height="160"
        ></AvatarComponent>
        <BButton
          class="edit-avatar position-absolute bg-primary rounded-circle text-center pt-2"
        >
          <FontAwesomeIcon
            :icon="['fas', 'pen']"
            size="1x"
            class="text-white edit-avatar-icon"
          />
        </BButton>
      </BRow>
      <BRow class="mt-3">
        <span class="fa-2x font-weight-bold mr-3">{{
          getLoggedUser.login
        }}</span>
        <span
          :class="
            `text-${getLoggedUser.onlineStatus.variant} font-weight-bold pt-3`
          "
          >{{ getLoggedUser.onlineStatus.text }}</span
        >
      </BRow>
      <BRow class="mt-3">
        <BCol cols="12" md="3" xs="6">
          <div class="text-secondary text-uppercase font-weight-bold fa-xs">
            Дата регистрации
          </div>
          <div class="w-50 mt-2">
            <div>
              {{ getLoggedUser.createdAt | moment('DD MMMM, H:MM') }}
            </div>
            <div>
              {{ getLoggedUser.createdAt | moment('from') }}
            </div>
          </div>
        </BCol>
        <BCol cols="12" md="9" xs="6">
          <UserRatingComponent :userRatings="userRatings"></UserRatingComponent>
        </BCol>
      </BRow>
    </BContainer>
    <BContainer>
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
    </BContainer>
  </div>
</template>

<script>
import RatingAndReviewsComponent from '@/components/user-rating/RatingAndReviewsComponent';
import UserOfferListComponent from '@/components/user-profile/user-offer/UserOfferListComponent';
import UserRatingComponent from '@/components/user-rating/UserRatingComponent';
import AvatarComponent from '@/components/user-profile/AvatarComponent';
import * as userRatingGetters from '@/store/modules/user-rating/types/getters';
import * as userRatingActions from '@/store/modules/user-rating/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as authGetters from '@/store/modules/auth/types/getters';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'UserProfile',
  components: {
    UserOfferListComponent,
    UserRatingComponent,
    RatingAndReviewsComponent,
    AvatarComponent
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    }),
    ...mapGetters('UserRating', {
      userRatings: userRatingGetters.GET_USER_RATINGS_BY_USER
    })
  },
  methods: {
    ...mapActions('UserRating', {
      getUserRatings: userRatingActions.GET_USER_RATINGS_BY_USER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async setUserRatings() {
      try {
        await this.getUserRatings();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  },
  async mounted() {
    await this.setUserRatings();
  }
};
</script>

<style scoped>
.avatar {
  z-index: 2;
  margin-top: -150px;
}
.edit-avatar {
  width: 40px;
  height: 40px;
  top: 10px;
  left: 125px;
}
.profile-cover-container {
  margin-top: -250px;
}
</style>
