<template>
  <div class="overflow-hidden rounded-circle">
    <img
      v-if="userPhoto"
      :width="width"
      :height="height"
      :src="userPhoto"
      alt=""
      class="img-fluid"
    />
    <img
      v-else
      src="@/assets/default-avatar.jpeg"
      :width="width"
      :height="height"
      alt=""
      class="img-fluid"
    />
  </div>
</template>

<script>
export default {
  name: 'AvatarComponent',
  props: {
    userPhoto: {
      type: String
    },
    width: {
      type: Number,
      default: 100
    },
    height: {
      type: Number,
      default: 100
    }
  }
};
</script>

<style scoped></style>
