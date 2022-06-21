<template>
  <div>
    <TitleComponent>Настройки</TitleComponent>
    <BContainer>
      <BRow class="border-bottom">
        <BCol cols="12" md="4">
          <h5 class="font-weight-bold">Личное</h5>
        </BCol>
        <BCol cols="12" md="8" class="m-3 m-md-0">
          <BRow class="d-flex">
            <div class="mb-3">
              <AvatarComponent
                :userPhoto="getLoggedUser.userPhoto"
                :width="115"
                :height="115"
              ></AvatarComponent>
            </div>
            <div class="ml-5 d-flex flex-column w-50">
              <BButton
                variant="light"
                class="pl-4 pr-4 mb-2 font-weight-bold shadow-none"
              >
                <RouterLink to="#" class="text-dark text-decoration-none"
                  >Изменить аватарку</RouterLink
                ></BButton
              >
              <BButton
                variant="light"
                class="pl-4 pr-4 mb-2 font-weight-bold shadow-none"
              >
                <RouterLink
                  :to="{ name: 'ChangePassword' }"
                  class="text-dark text-decoration-none"
                  >Изменить пароль</RouterLink
                ></BButton
              >
              <BButton
                variant="light"
                class="pl-4 pr-4 mb-2 font-weight-bold shadow-none"
              >
                <RouterLink
                  :to="{ name: 'BindEmail' }"
                  class="text-dark text-decoration-none"
                  >Изменить почту</RouterLink
                ></BButton
              >
              <BButton
                variant="light"
                class="pl-4 pr-4 mb-2 font-weight-bold shadow-none"
              >
                <RouterLink
                  :to="{ name: 'UserWallets' }"
                  class="text-dark text-decoration-none"
                  >Кошельки</RouterLink
                ></BButton
              >
            </div>
          </BRow>
        </BCol>
      </BRow>
      <BRow class="pt-4">
        <BCol cols="12" md="4">
          <h5 class="font-weight-bold">Оповещения</h5>
        </BCol>
        <BCol cols="12" md="8" class="m-3 m-md-0">
          <div>
            <BRow class="bg-light mb-3 p-4 rounded-lg">
              <FontAwesomeIcon
                class="text-primary mr-3"
                :icon="['fa', 'exclamation-circle']"
                size="lg"
              />
              <span>Мы будем оповещать вас о непрочитанных сообщениях.</span>
            </BRow>
            <BRow class="d-flex">
              <div
                class="setting-photo bg-primary rounded-circle position-relative"
              >
                <FontAwesomeIcon
                  class="setting-icon text-white position-absolute"
                  :icon="['fas', 'at']"
                  size="3x"
                />
              </div>
              <div class="ml-5 d-flex flex-column w-50">
                <h5 class="font-weight-bold">
                  Оповещения по электронной почте
                </h5>
                <p>
                  Приходят на почту, привязанную к учетной записи. Настройте
                  автоматическую проверку почты на своём телефоне (Android, iOS
                  и пр.), чтобы всегда быть на связи.
                </p>
                <BButton
                  @click="onToggleCurrentUserEmailNotification"
                  :variant="getLoggedUser.confirmSendEmail.variant"
                  class="pl-4 pr-4 mb-2 font-weight-bold shadow-none"
                >
                  {{ getLoggedUser.confirmSendEmail.text }}
                </BButton>
              </div>
            </BRow>
          </div>
        </BCol>
      </BRow>
    </BContainer>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import AvatarComponent from '@/components/user-profile/AvatarComponent';
import * as authGetters from '@/store/modules/auth/types/getters';
import * as userActions from '@/store/modules/auth/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'UserSettings',
  components: {
    TitleComponent,
    AvatarComponent
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    })
  },
  methods: {
    ...mapActions('AuthService', {
      toggleCurrentUserEmailNotification:
        userActions.TOGGLE_CURRENT_USER_EMAIL_NOTIFICATION
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async onToggleCurrentUserEmailNotification() {
      try {
        await this.toggleCurrentUserEmailNotification();
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped>
.setting-photo {
  width: 115px;
  height: 115px;
}
.setting-icon {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
