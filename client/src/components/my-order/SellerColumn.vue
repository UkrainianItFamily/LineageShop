<template>
  <BRow class="seller">
    <BCol md="3">
      <div class="seller-avatar position-relative">
        <AvatarComponent
          :userPhoto="user.userPhoto"
          :width="200"
          :height="200"
        ></AvatarComponent>
      </div>
    </BCol>
    <BCol md="9">
      <BRow class="seller-name">
        <RouterLink
          :to="{
            name: 'UserProfile',
            params: { id: this.user.id }
          }"
          class="font-weight-bold text-dark"
        >
          {{ user.login }}
        </RouterLink>
      </BRow>
      <BRow>
        <span
          class="text-uppercase fa-xs font-weight-bold"
          :class="isUserOnline.textVariant"
          >{{ isUserOnline.text }}</span
        >
      </BRow>
    </BCol>
  </BRow>
</template>

<script>
import AvatarComponent from '@/components/user-profile/AvatarComponent';
export default {
  name: 'SellerColumn',
  components: {
    AvatarComponent
  },
  props: {
    user: {
      id: Number,
      login: String,
      online: Number,
      userPhoto: String,
      createdAt: String
    }
  },
  computed: {
    isUserOnline() {
      if (this.user.online) {
        return {
          value: 1,
          text: 'онлайн',
          textVariant: 'text-success'
        };
      }
      return {
        value: 0,
        text: 'офлайн',
        textVariant: 'text-secondary'
      };
    }
  }
};
</script>

<style scoped></style>
