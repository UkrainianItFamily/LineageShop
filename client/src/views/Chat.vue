<template>
  <BContainer class="border">
    <ChatComponent></ChatComponent>
  </BContainer>
</template>

<script>
import ChatComponent from '@/components/chat/ChatComponent';
export default {
  name: 'Chat',
  components: { ChatComponent }
};
</script>

<style scoped></style>
