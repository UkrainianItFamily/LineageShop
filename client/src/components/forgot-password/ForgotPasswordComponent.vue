<template>
  <BCol md="4" ld="12">
    <BForm @submit.prevent="onForgotPassword">
      <BFormGroup id="input-group-2" label="ПОЧТА" label-for="input-2">
        <BFormInput
          id="input-2"
          type="text"
          v-model="$v.forgotPasswordData.email.$model"
          @blur="clickEmail"
          class="shadow-none"
        ></BFormInput>
        <div
          class="error bg-white text-danger mb-3"
          v-if="!$v.forgotPasswordData.email.required && clickedEmail"
        >
          Введите Email
        </div>
        <div
          class="error bg-white text-danger mb-3"
          v-if="!$v.forgotPasswordData.email.email && clickedEmail"
        >
          Вы ввели некорректный Email
        </div>
      </BFormGroup>
      <BButton type="submit" variant="primary">Восстановить пароль</BButton>
    </BForm>
  </BCol>
</template>

<script>
import { email, required } from 'vuelidate/lib/validators';
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/auth/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ForgotPasswordComponent',
  data() {
    return {
      clickedEmail: false,
      forgotPasswordData: {
        email: ''
      }
    };
  },
  validations: {
    forgotPasswordData: {
      email: {
        required,
        email
      }
    }
  },
  methods: {
    ...mapActions('AuthService', {
      forgotPassword: actions.FORGOT_PASSWORD
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    clickEmail() {
      this.clickedEmail = true;
    },

    validationRestorePasswordForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },

    async onForgotPassword() {
      if (!this.validationRestorePasswordForm()) {
        try {
          await this.forgotPassword(this.forgotPasswordData);

          await this.$router.push({ name: 'ResetPassword' });
        } catch (error) {
          this.setErrorNotification(error);
        }
      }
    }
  }
};
</script>

<style scoped></style>
