<template>
  <div>
    <TitleComponent>Админ панель финансовых операций</TitleComponent>
    <div>
      <FinanceOperationAdminPanelComponent></FinanceOperationAdminPanelComponent>
    </div>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import FinanceOperationAdminPanelComponent from '@/components/admin-panel/finance-operation/FinanceOperationAdminPanelComponent';

export default {
  name: 'FinanceOperationAdminPanel',
  components: {
    TitleComponent,
    FinanceOperationAdminPanelComponent
  }
};
</script>

<style scoped></style>
