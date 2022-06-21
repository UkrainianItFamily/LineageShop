<template>
  <div id="app">
    <NotificationsComponent></NotificationsComponent>
    <HeaderComponent></HeaderComponent>
    <BContainer class="content">
      <RouterView />
    </BContainer>
    <FooterComponent></FooterComponent>
  </div>
</template>

<style lang="scss">
@import 'scss/bootstrap.scss';
@import 'scss/common.scss';
</style>
<script>
import HeaderComponent from '@/components/main-layout-blocks/header/HeaderComponent';
import FooterComponent from '@/components/main-layout-blocks/footer/FooterComponent';
import NotificationsComponent from '@/components/notification/NotificationsComponent';
export default {
  components: { NotificationsComponent, FooterComponent, HeaderComponent }
};
</script>
