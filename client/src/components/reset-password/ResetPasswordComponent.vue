<template>
  <BCol md="4" ld="12">
    <BForm @submit.prevent="onResetPassword">
      <BFormGroup
        id="password-input"
        label="Введите новый пароль"
        label-for="password-input"
      >
        <BFormInput
          id="password-input"
          type="password"
          v-model="resetPasswordData.password"
          class="shadow-none"
        ></BFormInput>
      </BFormGroup>
      <BFormGroup
        id="confirm-password-input"
        label="Повторите новый пароль"
        label-for="confirm-password-input"
      >
        <BFormInput
          id="confirm-password-input"
          type="password"
          v-model="resetPasswordData.password_confirmation"
          class="shadow-none"
        ></BFormInput>
      </BFormGroup>
      <BButton type="submit" variant="primary">Изменить пароль</BButton>
    </BForm>
  </BCol>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/auth/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ResetPasswordComponent',
  data() {
    return {
      resetPasswordData: {
        password: '',
        password_confirmation: '',
        email: this.$route.query.email,
        token: this.$route.query.token
      }
    };
  },
  methods: {
    ...mapActions('AuthService', {
      resetPassword: actions.RESET_PASSWORD
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    async onResetPassword() {
      try {
        await this.resetPassword(this.resetPasswordData);

        await this.$router.push({ name: 'Auth' });
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
