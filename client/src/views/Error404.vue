<template>
  <div>
    <TitleComponent>Ошибка 404</TitleComponent>
    <div>
      Страница не найдена, вернуться на
      <RouterLink :to="{ name: 'Index' }">главную</RouterLink>.
    </div>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';

export default {
  name: 'Error404',
  components: {
    TitleComponent
  }
};
</script>

<style scoped></style>
