<template>
  <div>
    <TitleComponent>Админ панель</TitleComponent>
    <AdminPanelComponent></AdminPanelComponent>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import AdminPanelComponent from '@/components/admin-panel/AdminPanelComponent';

export default {
  name: 'AdminPanel',
  components: {
    TitleComponent,
    AdminPanelComponent
  }
};
</script>

<style scoped></style>
