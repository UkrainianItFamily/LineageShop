<template>
  <BContainer>
    <BRow>
      <BCol md="6" ld="12">
        <BForm @submit.prevent="onSendSupportRequest">
          <BFormGroup class="shadow-none">
            <label>Адрес эл. почты</label>
            <BFormInput
              v-model="$v.sendSupportRequestData.email.$model"
              class="shadow-none"
              @blur="clickEmail"
            ></BFormInput>
            <div
              class="error bg-white text-danger mb-2"
              v-if="!$v.sendSupportRequestData.email.required && clickedEmail"
            >
              Введите email
            </div>
            <div
              class="error bg-white text-danger mb-2"
              v-if="!$v.sendSupportRequestData.email.email && clickedEmail"
            >
              Введенный Email не корректен
            </div>
          </BFormGroup>
          <BFormGroup>
            <label>Тема</label>
            <BFormSelect
              v-model="$v.sendSupportRequestData.subject.$model"
              :options="options"
              class="shadow-none"
            ></BFormSelect>
          </BFormGroup>
          <BFormGroup>
            <label>Ваше имя (логин)</label>
            <BFormInput
              v-model="$v.sendSupportRequestData.login.$model"
              class="shadow-none"
              @blur="clickLogin"
            ></BFormInput>
            <div
              class="error bg-white text-danger mb-2"
              v-if="!$v.sendSupportRequestData.login.required && clickedLogin"
            >
              Введите имя (логин)
            </div>
          </BFormGroup>
          <BFormGroup>
            <label>Номер заказа</label>
            <BFormInput
              v-model="sendSupportRequestData.orderId"
              class="shadow-none"
              @blur="clickOrderId"
            ></BFormInput>
            <div
              class="error bg-white text-danger mb-2"
              v-if="
                !$v.sendSupportRequestData.orderId.integer && clickedOrderId
              "
            >
              Номер заказа не может содержать буквы
            </div>
          </BFormGroup>
          <BFormGroup>
            <label>Текст</label>
            <BFormTextarea
              v-model="$v.sendSupportRequestData.text.$model"
              class="shadow-none"
              @blur="clickText"
            ></BFormTextarea>
            <div
              class="error bg-white text-danger mb-2"
              v-if="!$v.sendSupportRequestData.text.required && clickedText"
            >
              Поле "Текст" не заполнено
            </div>
          </BFormGroup>
          <BButton type="submit" variant="primary" class="shadow-none"
            >Отправить</BButton
          >
        </BForm>
      </BCol>
    </BRow>
  </BContainer>
</template>

<script>
import * as supportActions from '@/store/modules/support-request/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import { required, email, integer } from 'vuelidate/lib/validators';
import * as authGetters from '@/store/modules/auth/types/getters';

export default {
  name: 'SupportRequest',
  data() {
    return {
      sendSupportRequestData: {
        email: '',
        subject: 0,
        orderId: null,
        login: '',
        text: ''
      },
      clickedEmail: false,
      clickedLogin: false,
      clickedText: false,
      clickedOrderId: false,
      options: [
        { value: 0, text: '-' },
        {
          value: 1,
          text: 'Я оплатил заказ, но продавец не отвечает мне'
        },
        {
          value: 2,
          text: 'Я недоволен выполнением заказа, хочу пожаловаться на продавца'
        },
        {
          value: 3,
          text: 'Платёж с моей банковской карты заблокирован'
        },
        {
          value: 4,
          text: 'Мой аккаунт BucksTrade заблокирован'
        },
        {
          value: 5,
          text: 'Покупатель забыл подтвердить заказ'
        },
        {
          value: 6,
          text: 'У меня есть проблемы с покупателем'
        },
        {
          value: 7,
          text: 'Пожаловаться на нарушение правил в чате'
        },
        {
          value: 8,
          text: 'Пожаловаться на нарушение правил в таблице предложений'
        },
        {
          value: 9,
          text: 'Проблема с платежом или выводом денег'
        },
        {
          value: 10,
          text: 'Восстановить доступ к аккаунту BucksTrade'
        },
        {
          value: 11,
          text: 'Отправить фотографии для отключения задержки'
        },
        {
          value: 12,
          text: 'Прочее'
        }
      ]
    };
  },
  validations: {
    sendSupportRequestData: {
      email: {
        required,
        email
      },
      subject: {
        integer
      },
      login: {
        required
      },
      orderId: {
        integer
      },
      text: {
        required
      }
    }
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    })
  },
  methods: {
    ...mapActions('SupportRequest', {
      sendSupportRequest: supportActions.SEND_SUPPORT_REQUEST
    }),
    ...mapActions('notification', {
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    clickEmail() {
      this.clickedEmail = true;
    },
    clickLogin() {
      this.clickedLogin = true;
    },
    clickText() {
      this.clickedText = true;
    },
    clickOrderId() {
      this.clickedOrderId = true;
    },
    validationSupportRequestForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },
    async onSendSupportRequest() {
      if (!this.validationSupportRequestForm()) {
        try {
          let successRequest = await this.sendSupportRequest(
            this.sendSupportRequestData
          );
          if (successRequest !== false) {
            await this.setSuccessNotification('Запрос отправлен');
            this.sendSupportRequestData = {
              email: this.getLoggedUser.email,
              subject: 0,
              orderId: null,
              login: this.getLoggedUser.login,
              text: ''
            };
            this.clickedEmail = false;
            this.clickedLogin = false;
            this.clickedText = false;
            this.clickedOrderId = false;
          }
        } catch (error) {
          this.setErrorNotification(error);
        }
      }
    },
    setUserLoginEmail() {
      this.$v.sendSupportRequestData.email.$model = this.getLoggedUser.email;
      this.$v.sendSupportRequestData.login.$model = this.getLoggedUser.login;
    }
  },
  mounted() {
    this.setUserLoginEmail();
  }
};
</script>

<style scoped></style>
