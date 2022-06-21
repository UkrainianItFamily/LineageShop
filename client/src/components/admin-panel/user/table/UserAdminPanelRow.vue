<template>
  <BTr>
    <BTh
      ><span :class="`text-${user.onlineStatus.variant}`">{{
        user.onlineStatus.text
      }}</span></BTh
    >
    <BTh>
      <BFormInput
        v-model="user.login"
        class="col-xs-12 shadow-none mr-2"
      ></BFormInput>
    </BTh>
    <BTh>
      <BFormInput
        v-model="user.email"
        type="email"
        class="col-xs-12 shadow-none mr-2"
      ></BFormInput>
    </BTh>
    <BTh>
      <BButton
        @click="onChangeUserData"
        variant="primary"
        class="font-weight-bold shadow-none"
      >
        Изменить
      </BButton>
    </BTh>
    <BTh>
      <BButton
        @click="onAdminResetUserPassword"
        variant="danger"
        class="font-weight-bold shadow-none"
        >Сбросить пароль</BButton
      >
    </BTh>
  </BTr>
</template>

<script>
import * as userActions from '@/store/modules/user/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'UserAdminPanelRow',
  props: {
    user: {
      id: Number,
      login: String,
      email: String,
      onlineStatus: {
        text: String,
        variant: String
      }
    }
  },
  computed: {
    getEmail() {
      return this.user.email;
    },
    getLogin() {
      return this.user.login;
    }
  },
  methods: {
    ...mapActions('User', {
      changeUserData: userActions.CHANGE_USER_DATA,
      adminResetUserPassword: userActions.ADMIN_RESET_USER_PASSWORD
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION,
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    async onAdminResetUserPassword() {
      try {
        await this.adminResetUserPassword({ id: this.user.id });
        await this.setSuccessNotification(
          'Сообщение о сбросе пароля отправлено пользователю'
        );
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    async onChangeUserData() {
      try {
        await this.changeUserData({
          id: this.user.id,
          login: this.user.login,
          email: this.user.email
        });
        await this.setSuccessNotification('Данные пользователя изменены');
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
