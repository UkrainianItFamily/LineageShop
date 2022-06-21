<template>
  <div>Авторизация через {{ provider }}</div>
</template>

<script>
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as actions from '@/store/modules/auth/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'SocialiteAuth',
  props: ['provider'],
  methods: {
    ...mapActions('AuthService', {
      fetchLoggedUser: actions.FETCH_LOGGED_USER,
      login: actions.PROVIDER_CALLBACK
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async loginUser() {
      await this.login({
        code: this.$route.query.code,
        provider: this.provider
      });
      await this.fetchLoggedUser();

      await this.$router.push({ name: 'Index' });
    }
  },
  mounted() {
    this.loginUser();
  }
};
</script>

<style scoped></style>
