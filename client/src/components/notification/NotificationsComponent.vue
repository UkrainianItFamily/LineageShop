<template>
  <div class="notifications-list">
    <template v-for="notification in notifications">
      <Notification
        :key="notification.id"
        :notification="notification"
      ></Notification>
    </template>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import * as notificationGetters from '@/store/modules/notification/types/getters';
import Notification from '@/components/notification/Notification';

export default {
  name: 'NotificationsComponent',
  components: { Notification },
  computed: {
    ...mapGetters('notification', {
      notifications: notificationGetters.GET_NOTIFICATIONS
    })
  }
};
</script>

<style scoped>
.notifications-list {
  position: absolute;
  bottom: 0;
  right: 0;
}
</style>
