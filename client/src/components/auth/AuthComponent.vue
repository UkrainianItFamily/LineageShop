<template>
  <BRow>
    <BCol md="4" ld="12">
      <BForm @submit.prevent="login">
        <BFormGroup id="email-group" label="ПОЧТА" label-for="email-input">
          <BFormInput
            id="email-input"
            v-model="$v.loginData.email.$model"
            @blur="clickEmail"
            class="shadow-none"
          ></BFormInput>
          <div
            class="error bg-white text-danger mb-2"
            v-if="!$v.loginData.email.required && clickedEmail"
          >
            Введите email
          </div>
          <div
            class="error bg-white text-danger mb-2"
            v-if="!$v.loginData.email.email && clickedEmail"
          >
            Введенный Email не корректен
          </div>
        </BFormGroup>
        <BFormGroup
          id="password-group"
          label="ПАРОЛЬ"
          label-for="password-input"
        >
          <BFormInput
            id="password-input"
            type="password"
            v-model="$v.loginData.password.$model"
            @blur="clickPassword"
            class="shadow-none"
          ></BFormInput>
          <div
            class="error bg-white text-danger mb-2"
            v-if="!$v.loginData.password.required && clickedPassword"
          >
            Введите пароль
          </div>
          <div
            class="error bg-white text-danger mb-2"
            v-if="!$v.loginData.password.minLength && clickedPassword"
          >
            Пароль должен содержать минимум
            {{ $v.loginData.password.$params.minLength.min }} символов
          </div>
        </BFormGroup>
        <BButton type="submit" variant="primary">Войти</BButton>
        <RouterLink class="ml-3" :to="{ name: 'ForgotPassword' }"
          >Забыл пароль?</RouterLink
        >
      </BForm>
    </BCol>
    <BCol md="3" ld="12" class="d-flex flex-column">
      <BButton
        @click="socialite('google')"
        class="mt-2"
        variant="outline-secondary"
      >
        Вход через Google
        <FontAwesomeIcon :icon="['fab', 'google']" size="lg" class="ml-1" />
      </BButton>
      <BButton
        @click="socialite('yandex')"
        class="mt-2"
        variant="outline-secondary"
      >
        Вход через Yandex
        <FontAwesomeIcon :icon="['fab', 'yandex']" size="lg" class="ml-1" />
      </BButton>
      <BButton
        @click="socialite('facebook')"
        class="mt-2"
        variant="outline-secondary"
      >
        Вход через FB
        <FontAwesomeIcon
          :icon="['fab', 'facebook-square']"
          size="lg"
          class="ml-1"
        />
      </BButton>
      <BButton
        @click="socialite('vkontakte')"
        class="mt-2"
        variant="outline-secondary"
      >
        Вход через VK
        <FontAwesomeIcon :icon="['fab', 'vk']" size="lg" class="ml-1" />
      </BButton>
      <BButton
        @click="socialite('discord')"
        class="mt-2"
        variant="outline-secondary"
      >
        Вход через Discord
        <FontAwesomeIcon :icon="['fab', 'discord']" size="lg" class="ml-1" />
      </BButton>
    </BCol>
  </BRow>
</template>

<script>
import * as notificationActions from '@/store/modules/notification/types/actions';
import { required, minLength, email } from 'vuelidate/lib/validators';
import * as actions from '@/store/modules/auth/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'AuthComponent',
  data() {
    return {
      clickedEmail: false,
      clickedPassword: false,
      loginData: {
        email: '',
        password: ''
      }
    };
  },
  validations: {
    loginData: {
      email: {
        required,
        email
      },
      password: {
        required,
        minLength: minLength(8)
      }
    }
  },
  methods: {
    ...mapActions('AuthService', {
      fetchLoggedUser: actions.FETCH_LOGGED_USER,
      signIn: actions.SIGN_IN,
      signInByProvider: actions.SIGN_IN_BY_PROVIDER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    clickEmail() {
      this.clickedEmail = true;
    },
    clickPassword() {
      this.clickedPassword = true;
    },
    validationLoginForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },
    async login() {
      if (!this.validationLoginForm()) {
        try {
          await this.signIn(this.loginData);
          await this.fetchLoggedUser();

          await this.$router.push({ name: 'Index' });
        } catch (error) {
          this.setErrorNotification(error);
        }
      }
    },
    async socialite(provider) {
      await this.signInByProvider(provider);
    }
  }
};
</script>

<style scoped></style>
