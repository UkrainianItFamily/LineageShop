<template>
  <BRow class="seller">
    <BCol cols="12" md="4">
      <div
        class="seller-avatar position-relative"
        :class="getStatusOnline(user.online)"
      >
        <AvatarComponent
          :width="40"
          :height="40"
          :userPhoto="user.userPhoto"
        ></AvatarComponent>
      </div>
    </BCol>
    <BCol cols="12" md="8">
      <BRow class="seller-name">
        <RouterLink
          :to="{
            name: 'UserProfile',
            params: { id: this.user.id }
          }"
          class="font-weight-bold text-secondary"
        >
          {{ user.login }}
        </RouterLink>
      </BRow>
      <BRow
        class="seller-reviews seller-reviews-cool d-flex align-items-center fa-xs"
      >
        <FontAwesomeIcon :icon="['fas', 'star']" size="xs" />
        <FontAwesomeIcon :icon="['fas', 'star']" size="xs" />
        <FontAwesomeIcon :icon="['fas', 'star']" size="xs" />
        <FontAwesomeIcon :icon="['fas', 'star']" size="xs" />
        <FontAwesomeIcon :icon="['fas', 'star']" size="xs" />
        <span class="rating-count text-secondary ml-1">23</span>
      </BRow>
      <BRow class="seller-info font-weight-bold text-secondary fa-xs"
        >на сайте 5 лет</BRow
      >
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
      online: Boolean,
      userPhoto: String
    }
  },

  methods: {
    getStatusOnline(statusOnline) {
      if (statusOnline) {
        return 'seller-online';
      }

      return 'seller-offline';
    }
  }
};
</script>

<style scoped>
.seller-avatar {
  width: 40px;
  height: 40px;
}
.seller-avatar::before {
  display: block;
  width: 16px;
  height: 16px;
  border: 3px solid white;
  border-radius: 50%;
  content: '';
  position: absolute;
  right: -3px;
  bottom: -3px;
}
</style>
