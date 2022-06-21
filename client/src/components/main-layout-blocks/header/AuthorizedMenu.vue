<template>
  <BNavbarNav class="ml-auto authorized-menu">
    <BNavItem :to="{ name: 'MyPurchases' }">Покупки</BNavItem>
    <BNavItem :to="{ name: 'MySales' }">Продажи</BNavItem>
    <BNavItem :to="{ name: 'Chat' }">Сообщения</BNavItem>
    <BNavItem :to="{ name: 'Finances' }">Финансы</BNavItem>
    <BNavItemDropdown right>
      <template #button-content>
        <div class="user-link-photo">
          <img alt="" src="@/assets/default-avatar.jpeg" />
        </div>
      </template>
      <BDropdownItem :to="{ name: 'UserSelfProfile' }">
        <span class="user-link-name">{{ this.user.login }}</span>
        <span class="user-link-desc">Профиль</span>
      </BDropdownItem>
      <BDropdownItem class="border-top" :to="{ name: 'UserSettings' }">
        Настройки
      </BDropdownItem>
      <BDropdownItem class="border-top" href="#">
        English
        <img width="18" height="18" alt="" src="@/assets/eng.svg" />
      </BDropdownItem>
      <BDropdownItem class="border-top" @click="exit()">
        Выйти
      </BDropdownItem>
    </BNavItemDropdown>
  </BNavbarNav>
</template>

<script>
import { mapActions } from 'vuex';
import * as authActions from '@/store/modules/auth/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'AuthorizedMenu',
  props: {
    user: {
      login: String
    }
  },
  methods: {
    ...mapActions('AuthService', {
      signOut: authActions.SIGN_OUT
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    async exit() {
      try {
        await this.signOut();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
