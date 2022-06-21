<template>
  <BAlert
    :show="dismissCountDown"
    dismissible
    fade
    :variant="notification.variant"
    @dismissed="onDismissed"
    @dismiss-count-down="countDownChanged"
  >
    <p>{{ notification.text }}</p>
  </BAlert>
</template>

<script>
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'Notification',
  data() {
    return {
      dismissSecs: 4,
      dismissCountDown: 0
    };
  },

  props: {
    notification: {
      id: Number,
      showing: Boolean,
      text: String,
      variant: String
    }
  },

  methods: {
    ...mapActions('notification', {
      removeErrorNotification: notificationActions.REMOVE_ERROR_NOTIFICATION
    }),

    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },

    openAlert() {
      this.dismissCountDown = this.dismissSecs;
    },

    onDismissed() {
      this.removeErrorNotification(this.notification.id);
    }
  },

  mounted() {
    this.openAlert();
  }
};
</script>

<style scoped>
.alert {
  z-index: 9999;
}
</style>
