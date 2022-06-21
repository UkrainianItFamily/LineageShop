<template>
  <RouterView></RouterView>
</template>

<script>
import authService from '@/services/auth/AuthService';
import store from '@/store';
import * as actions from '@/store/modules/auth/types/actions';

export default {
  name: 'UserDataProviderComponent',
  async beforeRouteEnter(to, from, next) {
    if (!store.state.AuthService.user && authService.hasToken()) {
      await store.dispatch('AuthService/' + actions.FETCH_LOGGED_USER);
      next();
    } else {
      next();
    }
  }
};
</script>

<style scoped></style>
