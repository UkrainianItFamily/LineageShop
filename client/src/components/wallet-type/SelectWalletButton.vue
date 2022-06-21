<template>
  <div class="param-item mt-4">
    <h5 class="param-title unique-font">
      Способ оплаты
    </h5>
    <BDropdown
      variant="light"
      size="xs"
      class="w-100"
      toggle-class="shadow-none"
      menu-class="w-100"
    >
      <template #button-content>
        {{ selectedWalletType.name }}
      </template>
      <BDropdownItem
        v-for="walletType in getOptionsWalletTypes"
        :key="walletType.id"
        @click="selectWalletType(walletType)"
      >
        {{ walletType.name }}
      </BDropdownItem>
    </BDropdown>
    <!--    <div class="text-black-50">-->
    <!--      Ваш регион — Украина. Если это неверно,-->
    <!--      <RouterLink to="#">нажмите здесь</RouterLink>.-->
    <!--    </div>-->
  </div>
</template>

<script>
import _ from 'lodash';

export default {
  name: 'SelectWalletButton',
  props: {
    walletTypes: Object
  },
  data() {
    return {
      selectedWalletType: {
        id: null,
        name: 'Выберите тип оплаты'
      }
    };
  },
  computed: {
    getOptionsWalletTypes() {
      let optionsWalletTypes = [];
      _.map(this.walletTypes, function(userWallet) {
        optionsWalletTypes.push({
          id: userWallet.id,
          name: userWallet.name
        });
      });
      return optionsWalletTypes;
    }
  },
  methods: {
    selectWalletType(walletType) {
      this.selectedWalletType = {
        id: walletType.id,
        name: walletType.name
      };
      this.$emit('getWalletTypeId', this.selectedWalletType.id);
    }
  }
};
</script>

<style scoped></style>
