<template>
  <div>
    <TitleComponent>Подтверждение e-mail</TitleComponent>
    <div>
      <EmailVerificationComponent></EmailVerificationComponent>
    </div>
  </div>
</template>

<script>
import TitleComponent from '@/components/main-layout-blocks/title/TitleComponent';
import EmailVerificationComponent from '@/components/email-verification/EmailVerificationComponent';
export default {
  name: 'EmailVerification',
  components: { EmailVerificationComponent, TitleComponent }
};
</script>

<style scoped></style>
