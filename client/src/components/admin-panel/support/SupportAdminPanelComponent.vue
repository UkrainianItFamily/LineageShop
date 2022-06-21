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
          <BFormSelectOption value="null"></BFormSelectOption>
          <BFormSelectOption value="1">Открыт</BFormSelectOption>
          <BFormSelectOption value="2">Закрыт</BFormSelectOption>
        </BFormSelect>
      </div>
    </BRow>
    <SupportAdminPanelTable
      v-if="isSetSupports"
      :supports="supports(orderType, orderDirection)"
      @orderType="setOrderType"
    ></SupportAdminPanelTable>
    <EmptyAdminPanelComponent v-else>записей</EmptyAdminPanelComponent>
  </div>
</template>

<script>
import SupportAdminPanelTable from './table/SupportAdminPanelTable';
import EmptyAdminPanelComponent from '../EmptyAdminPanelComponent';
import * as SupportGetters from '@/store/modules/support-request/types/getters';
import * as SupportActions from '@/store/modules/support-request/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'SupportAdminPanelComponent',
  components: {
    SupportAdminPanelTable,
    EmptyAdminPanelComponent
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
    isSetSupports() {
      return !_.isEmpty(this.supports(this.orderType, this.orderDirection));
    }
  },
  methods: {
    ...mapActions('SupportRequest', {
      getSupportRequestsByCriteria:
        SupportActions.GET_SUPPORT_REQUESTS_BY_CRITERIA
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),
    inputUserLogin() {
      this.supportId = '';
    },
    async setSupportsByCriteria() {
      try {
        await this.getSupportRequestsByCriteria({
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
    await this.setSupportsByCriteria();
  },
  watch: {
    supportId: ['setSupportsByCriteria'],
    startDate: ['setSupportsByCriteria'],
    endDate: ['setSupportsByCriteria'],
    statusId: ['setSupportsByCriteria']
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
