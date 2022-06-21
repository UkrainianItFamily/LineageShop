<template>
  <div>
    <TitleComponent>Тест сервисов</TitleComponent>
    <div>
      <StatusTableComponent />
    </div>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import StatusTableComponent from '@/components/status/StatusTableComponent.vue';

export default {
  name: 'Status',
  components: {
    TitleComponent,
    StatusTableComponent
  }
};
</script>
