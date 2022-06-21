<template>
  <BRow>
    <BCol cols="12">
      <BTableSimple borderless hover>
        <BThead class="border-bottom pb-3">
          <BTr>
            <BTh>Онлайн статус</BTh>
            <BTh>Логин</BTh>
            <BTh>Email</BTh>
            <BTh> </BTh>
            <BTh>Сбросить пароль</BTh>
          </BTr>
        </BThead>
        <BTbody>
          <UserAdminPanelRow
            v-for="user in users"
            :key="user.id"
            :user="user"
          ></UserAdminPanelRow>
        </BTbody>
      </BTableSimple>
    </BCol>
  </BRow>
</template>

<script>
import UserAdminPanelRow from './UserAdminPanelRow';

export default {
  name: 'UserAdminPanelTable',
  components: {
    UserAdminPanelRow
  },
  props: {
    users: Object
  }
};
</script>

<style scoped></style>
