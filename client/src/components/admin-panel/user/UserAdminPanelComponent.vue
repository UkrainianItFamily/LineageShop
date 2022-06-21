<template>
  <div>
    <div class="text-uppercase text-secondary mb-3">
      пользователи
    </div>
    <UserAdminPanelTable :users="users"></UserAdminPanelTable>
  </div>
</template>

<script>
import UserAdminPanelTable from './table/UserAdminPanelTable';
import * as userGetters from '@/store/modules/user/types/getters';
import * as userActions from '@/store/modules/user/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'UserAdminPanelComponent',
  components: {
    UserAdminPanelTable
  },
  computed: {
    ...mapGetters('User', {
      users: userGetters.GET_USERS
    })
  },
  methods: {
    ...mapActions('User', {
      getUsers: userActions.GET_USERS
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    })
  },
  async mounted() {
    try {
      await this.getUsers();
    } catch (error) {
      this.setErrorNotification(error);
    }
  }
};
</script>

<style scoped></style>
