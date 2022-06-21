<template>
  <div class="border-top pt-3 mb-3">
    <BRow>
      <BCol cols="2">
        <AvatarComponent
          :userPhoto="userRating.userCustomer.userPhoto"
        ></AvatarComponent>
      </BCol>
      <BCol cols="6">
        <BRow class="mb-2"
          ><div class="reviews-item-date mr-3">
            {{ userRating.createdAt | moment('from') }}
          </div>
          <div class="reviews-item-details text-secondary font-weight-bold">
            {{ userRating.userCustomer.login }}
            {{ userRating.order.productPrice }} ₽
          </div>
        </BRow>
        <BRow>
          {{ userRating.text }}
        </BRow>
      </BCol>
      <BCol cols="4">
        <BFormRating
          v-model="userRating.rating"
          class="mb-2 shadow-none seller-reviews-cool"
          no-border
          readonly
          size="xs"
        ></BFormRating>
      </BCol>
    </BRow>
  </div>
</template>

<script>
import AvatarComponent from '@/components/user-profile/AvatarComponent';

export default {
  name: 'UserReviewComponent',
  components: {
    AvatarComponent
  },
  props: {
    userRating: {
      userCustomer: {
        login: String,
        userPhoto: String
      },
      rating: Number,
      order: {
        productPrice: Number
      },
      createdAt: String
    }
  }
};
</script>

<style scoped></style>
