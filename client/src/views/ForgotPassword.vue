<template>
  <div>
    <TitleComponent>Восстановление Пароля</TitleComponent>
    <ForgotPasswordComponent></ForgotPasswordComponent>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import ForgotPasswordComponent from '@/components/forgot-password/ForgotPasswordComponent';

export default {
  name: 'ForgotPassword',
  components: { ForgotPasswordComponent, TitleComponent }
};
</script>

<style scoped></style>
