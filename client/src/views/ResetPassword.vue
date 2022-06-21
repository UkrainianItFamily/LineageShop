<template>
  <div>
    <TitleComponent>Изменение пароля</TitleComponent>
    <ResetPasswordComponent></ResetPasswordComponent>
  </div>
</template>

<script>
import ResetPasswordComponent from '@/components/reset-password/ResetPasswordComponent';
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
export default {
  name: 'ResetPassword',
  components: { TitleComponent, ResetPasswordComponent }
};
</script>

<style scoped></style>
