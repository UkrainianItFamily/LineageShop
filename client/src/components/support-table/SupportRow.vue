<template>
  <BTr>
    <BTh># {{ support.id }}</BTh>
    <BTh>
      <RouterLink :to="{ name: 'SupportChat', params: { id: support.id } }"
        >{{ support.subject.label }}
      </RouterLink>
    </BTh>
    <BTh>{{ new Date(support.createdAt).toLocaleDateString() }}</BTh>
    <BTh>{{ new Date(support.updatedAt).toLocaleDateString() }}</BTh>
    <BTh>{{ support.status.label }}</BTh>
  </BTr>
</template>

<script>
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'SupportAdminPanelRow',
  props: {
    support: {
      id: Number,
      subject: {
        id: Number,
        title: String
      },
      authorId: Number,
      login: String,
      status: {
        id: Number,
        title: String
      },
      createdAt: String,
      order_id: Number
    }
  },
  data() {
    return {
      changeSupportStatusData: {
        id: this.support.id,
        status: this.support.status.value
      }
    };
  },
  methods: {
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION,
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    })
  }
};
</script>

<style scoped></style>
