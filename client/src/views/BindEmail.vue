<template>
  <div class="m-3 m-md-0">
    <TitleComponent>Изменение почту</TitleComponent>
    <BContainer>
      <BRow>
        <BCol md="3" ld="12">
          <BFormGroup>
            <label class="text-uppercase text-secondary fa-xs">почта</label>
            <BFormInput
              v-model="getLoggedUser.email"
              type="email"
              class="shadow-none"
            ></BFormInput>
          </BFormGroup>
          <BButton @click="onBindEmail" variant="primary" class="shadow-none"
            >Изменить почту</BButton
          >
        </BCol>
      </BRow>
    </BContainer>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import * as notificationActions from '@/store/modules/notification/types/actions';
import * as userActions from '@/store/modules/user/types/actions';
import * as authGetters from '@/store/modules/auth/types/getters';
import * as authActions from '@/store/modules/auth/types/actions';
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'BindEmail',
  components: {
    TitleComponent
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    })
  },
  methods: {
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    ...mapActions('User', {
      bindEmail: userActions.BIND_EMAIL
    }),
    ...mapActions('AuthService', {
      changeEmail: authActions.CHANGE_EMAIL
    }),
    async onBindEmail() {
      try {
        await this.bindEmail({ email: this.getLoggedUser.email });
        await this.setSuccessNotification(
          'Письмо с подтверждением отправлено.'
        );
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  },
  async mounted() {
    if (this.$route.query.token) {
      try {
        await this.changeEmail({ token: this.$route.query.token });
        await this.setSuccessNotification('Почта удачно изменена.');
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
