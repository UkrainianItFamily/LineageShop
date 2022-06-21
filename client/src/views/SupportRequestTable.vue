<template>
  <div>
    <div class="text-uppercase text-secondary mb-3">
      Запросы в тех. поддержку
    </div>
    <BRow class="align-items-end">
      <div>
        <BFormInput
          v-model="supportId"
          size="sm"
          type="number"
          placeholder="Поиск по ID"
          class="shadow-none"
        />
      </div>
      <div class="d-flex flex-column align-items-center">
        <span class="text-secondary unique-font">Дата создания</span>
        <div class="d-flex">
          <BFormInput
            type="date"
            v-model="startDate"
            size="sm"
            class="level-input ml-2 shadow-none"
          />
          <span class="d-flex justify-content-center mx-2"> -</span>
          <BFormInput
            type="date"
            v-model="endDate"
            size="sm"
            class="level-input shadow-none"
          />
        </div>
      </div>
      <div class="d-flex flex-column align-items-center mx-2">
        <span class="text-secondary unique-font">Статус тикета</span>
        <BFormSelect size="sm" v-model="statusId">
          <BFormSelectOption value=""></BFormSelectOption>
          <BFormSelectOption :value="$getConst('SUPPORT_REQUEST_STATUS').OPEN">
            Открыт
          </BFormSelectOption>
          <BFormSelectOption :value="$getConst('SUPPORT_REQUEST_STATUS').CLOSE">
            Закрыт
          </BFormSelectOption>
          <BFormSelectOption
            :value="$getConst('SUPPORT_REQUEST_STATUS').UNREAD"
          >
            Не прочитанно
          </BFormSelectOption>
          <BFormSelectOption :value="$getConst('SUPPORT_REQUEST_STATUS').READ">
            Прочитанно
          </BFormSelectOption>
        </BFormSelect>
      </div>
    </BRow>
    <SupportTable
      v-if="isSetSupports"
      :supports="supports(orderType, orderDirection)"
      @orderType="setOrderType"
    />
    <EmptyTableComponent v-else>записей</EmptyTableComponent>
  </div>
</template>

<script>
import SupportTable from '@/components/support-table/SupportTable';
import EmptyTableComponent from '@/components/support-table/EmptyTableComponent';
import * as SupportGetters from '@/store/modules/support-request/types/getters';
import * as AuthGetters from '@/store/modules/auth/types/getters';
import * as SupportActions from '@/store/modules/support-request/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'SupportRequestTable',
  components: {
    SupportTable,
    EmptyTableComponent
  },
  data() {
    return {
      supportId: '',
      orderType: '',
      orderDirection: '',
      startDate: null,
      endDate: null,
      statusId: ''
    };
  },
  computed: {
    ...mapGetters('SupportRequest', {
      supports: SupportGetters.GET_SUPPORT_REQUESTS
    }),
    ...mapGetters('AuthService', {
      getLoggedUser: AuthGetters.GET_LOGGED_USER
    }),
    isSetSupports() {
      return !_.isEmpty(this.supports(this.orderType, this.orderDirection));
    }
  },
  methods: {
    ...mapActions('SupportRequest', {
      getSupportsByCriteriaForUser:
        SupportActions.GET_SUPPORT_REQUESTS_BY_CRITERIA
    }),
    ...mapActions('Auth', {
      getLoggedUser: AuthGetters.GET_LOGGED_USER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    async setSupportsByCriteriaForUser() {
      try {
        await this.getSupportsByCriteriaForUser({
          userId: this.getLoggedUser.id,
          id: this.supportId,
          startDate: this.startDate,
          endDate: this.endDate,
          statusId: this.statusId
        });
      } catch (error) {
        this.setErrorNotification(error);
      }
    },
    setOrderType(orderTypeObject) {
      this.orderType = orderTypeObject.orderName;
      this.orderDirection = orderTypeObject.orderDirection;
    }
  },
  async mounted() {
    await this.setSupportsByCriteriaForUser();
  },
  watch: {
    supportId: ['setSupportsByCriteriaForUser'],
    startDate: ['setSupportsByCriteriaForUser'],
    endDate: ['setSupportsByCriteriaForUser'],
    statusId: ['setSupportsByCriteriaForUser']
  }
};
</script>

<style scoped>
input {
  width: 135px;
}
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  display: none;
}
</style>
