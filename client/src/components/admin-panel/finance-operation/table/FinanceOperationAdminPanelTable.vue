<template>
  <BRow>
    <BCol cols="12">
      <BTableSimple borderless hover>
        <BThead class="border-bottom pb-3">
          <BTr>
            <BTh>ID</BTh>
            <BTh>Логин пользователя</BTh>
            <BTh class="text-md-left">
              <BButton
                size="sm"
                variant="white"
                @click="selectOrderType('type')"
                class="font-weight-normal pointer-event shadow-none p-0 m-0"
              >
                Тип
                <span class="ml-1">
                  <FontAwesomeIcon :icon="['fas', selectTypeSortIcon]" />
                </span>
              </BButton>
            </BTh>
            <BTh class="text-md-left">
              <BButton
                size="sm"
                variant="white"
                @click="selectOrderType('status')"
                class="font-weight-normal pointer-event shadow-none p-0 m-0"
              >
                Статус
                <span class="ml-1">
                  <FontAwesomeIcon :icon="['fas', selectStatusSortIcon]" />
                </span>
              </BButton>
            </BTh>
            <BTh class="text-md-left">
              <BButton
                size="sm"
                variant="white"
                @click="selectOrderType('created_at')"
                class="font-weight-normal pointer-event shadow-none p-0 m-0"
              >
                Дата
                <span class="ml-1">
                  <FontAwesomeIcon :icon="['fas', selectDateSortIcon]" />
                </span>
              </BButton>
            </BTh>
            <BTh> </BTh>
            <BTh> </BTh>
            <BTh> </BTh>
          </BTr>
        </BThead>
        <BTbody>
          <FinanceOperationAdminPanelRow
            v-for="financeOperation in financeOperations"
            :key="financeOperation.id"
            :financeOperation="financeOperation"
          />
        </BTbody>
      </BTableSimple>
    </BCol>
  </BRow>
</template>

<script>
import FinanceOperationAdminPanelRow from './FinanceOperationAdminPanelRow';

export default {
  name: 'FinanceOperationAdminPanelTable',
  components: {
    FinanceOperationAdminPanelRow
  },
  data() {
    return {
      orderType: '',
      orderDirection: ''
    };
  },
  props: {
    financeOperations: Array
  },
  computed: {
    selectTypeSortIcon() {
      if (this.orderType === 'type') {
        return this.orderDirection === 'DESC' ? 'caret-up' : 'caret-down';
      }
      return 'sort';
    },
    selectStatusSortIcon() {
      if (this.orderType === 'status') {
        return this.orderDirection === 'DESC' ? 'caret-up' : 'caret-down';
      }
      return 'sort';
    },
    selectDateSortIcon() {
      if (this.orderType === 'created_at') {
        return this.orderDirection === 'DESC' ? 'caret-up' : 'caret-down';
      }
      return 'sort';
    }
  },
  methods: {
    selectOrderType(orderType) {
      this.orderDirection = this.orderDirection === 'DESC' ? 'ASC' : 'DESC';
      this.orderType = orderType;
      let orderParameters = {
        orderType: this.orderType,
        orderDirection: this.orderDirection
      };
      return this.$emit('orderParameters', orderParameters);
    }
  }
};
</script>

<style scoped></style>
