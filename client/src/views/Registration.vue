<template>
  <div>
    <TitleComponent>Регистрация</TitleComponent>
    <RegistrationComponent></RegistrationComponent>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import RegistrationComponent from '@/components/registration/RegistrationComponent';

export default {
  name: 'Registration',
  components: { RegistrationComponent, TitleComponent }
};
</script>

<style scoped></style>
