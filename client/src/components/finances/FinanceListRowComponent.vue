<template>
  <BTr>
    <ModalDetailsInfoComponent :financeOperation="financeOperation" />
    <BTh class="product-description font-weight-normal">
      {{ financeOperation.createdAt | moment('Y.M.D HH:mm') }}

      <span class="text-secondary ml-1">
        ({{ financeOperation.createdAt | moment('from') }})
      </span>
    </BTh>
    <BTh class="product-description font-weight-normal">
      <span>{{ financeOperation.type.title }}</span>
      денег #{{ financeOperation.id }}
      <span class="text-secondary ml-2">
        {{ financeOperation.wallet.info }}
      </span>
      <FontAwesomeIcon :icon="['fas', 'credit-card']" size="1x" class="ml-1" />
    </BTh>
    <BTh
      :class="
        `product-description font-weight-bold text-${financeOperation.status.variant}`
      "
    >
      {{ financeOperation.status.title }}
    </BTh>
    <BTh class="product-description font-weight-bold text-md-right">
      <span v-if="!financeOperation.type.isEnrollment">-</span>
      {{ financeOperation.money }} ₽
      <span v-b-modal="`finance-details${financeOperation.id}`">
        <FontAwesomeIcon
          :icon="['fas', 'chevron-right']"
          size="1x"
          class="text-primary ml-1"
        />
      </span>
    </BTh>
  </BTr>
</template>

<script>
import ModalDetailsInfoComponent from '@/components/finances/modal/ModalDetailsInfoComponent';

export default {
  name: 'FinanceListRowComponent',
  components: {
    ModalDetailsInfoComponent
  },
  props: {
    financeOperation: {
      id: Number,
      money: String,
      status: {
        title: String,
        variant: String,
        value: Number,
        isExecuted: Boolean,
        isCanceled: Boolean
      },
      createdAt: String,
      wallet: {
        id: Number,
        info: String,
        type: {
          id: Number,
          name: String,
          walletSymbol: String
        }
      }
    }
  }
};
</script>

<style scoped></style>
