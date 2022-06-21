<template>
  <div>
    <!--    <BRow class="p-3 d-flex justify-content-between">-->
    <!--      <div class="d-flex">-->
    <!--        <BAvatar class="mr-3"></BAvatar>-->
    <!--        <div>-->
    <!--          <strong>Nickname</strong>-->
    <!--          <div class="text-secondary">Ссори не тут</div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div>24.01</div>-->
    <!--    </BRow>-->
    <template v-for="chat in chats">
      <Chat :key="chat.id" :chat="chat"></Chat>
    </template>
  </div>
</template>

<script>
import Chat from '@/components/chat/chats-list/Chat';

export default {
  name: 'ChatsListComponent',
  components: { Chat },
  props: {
    chats: Object
  }
};
</script>

<style scoped></style>
