<template>
  <RouterLink :to="{ name: 'OpenChat', params: { chatId: chat.id } }">
    <BRow class="p-3 d-flex justify-content-between">
      <div class="d-flex">
        <BAvatar class="mr-3" :src="chat.recipientUser.userPhoto"></BAvatar>
        <div>
          <strong class="login">{{ chat.recipientUser.login }}</strong>
          <!--          <div class="text-light">Сообщение скрыто</div>-->
        </div>
      </div>
      <!--    <div class="text-light">18.03</div>-->
    </BRow>
  </RouterLink>
</template>

<script>
export default {
  name: 'Chat',
  props: {
    chat: {
      id: Number,
      recipientUser: {
        id: Number,
        login: String,
        online: Boolean,
        userPhoto: String
      }
    }
  }
};
</script>

<style scoped lang="scss">
a {
  text-decoration: none;
}
.router-link-exact-active {
  .row {
    background-color: #007bff;
  }

  .login {
    color: #ffffff;
  }
}

.login {
  color: #222222;
}
</style>
