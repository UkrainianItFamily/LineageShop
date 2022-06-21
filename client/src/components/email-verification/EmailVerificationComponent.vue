<template>
  <BCol md="4" ld="12">
    <BForm @submit.prevent="onVerifiedEmail">
      <BFormGroup id="hash-group" label="Проверочный код" label-for="hash">
        <BFormInput
          id="hash-input"
          v-model="$v.verifiedEmailData.hash.$model"
          :class="status($v.verifiedEmailData.hash)"
        ></BFormInput>
      </BFormGroup>
      <BButton type="submit" variant="primary"
        >Активировать учетную запись</BButton
      >
    </BForm>
  </BCol>
</template>

<script>
import _ from 'lodash';
import { required } from 'vuelidate/lib/validators';
import { mapActions } from 'vuex';
import * as authActions from '@/store/modules/auth/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'EmailVerificationComponent',
  data() {
    return {
      verifiedEmailData: {
        hash: '',
        id: this.$route.query
      }
    };
  },
  validations: {
    verifiedEmailData: {
      hash: {
        required
      },
      id: {
        required
      }
    }
  },
  mounted() {
    this.verifiedEmailData.hash = _.get(this.$route, 'query.hash', null);
    this.verifiedEmailData.id = _.get(this.$route, 'query.id', null);
  },
  methods: {
    ...mapActions('AuthService', {
      verifiedEmail: authActions.VERIFIED_EMAIL
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    status(validation) {
      return {
        error: validation.$error,
        dirty: validation.$dirty
      };
    },

    async onVerifiedEmail() {
      try {
        await this.verifiedEmail(this.verifiedEmailData);

        await this.$router.push({ name: 'Auth' });
      } catch (error) {
        this.setErrorNotification(error);
      }
    }
  }
};
</script>

<style scoped></style>
