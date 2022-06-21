<template>
  <div>
    <SupportChatAdminComponent
      :supportMessages="supportMessages"
    ></SupportChatAdminComponent>
  </div>
</template>

<script>
import SupportChatAdminComponent from '@/components/admin-panel/support-chat/SupportChatAdminComponent';
import * as SupportGetters from '@/store/modules/support-request/types/getters';
import { mapGetters } from 'vuex';

export default {
  name: 'SupportChatAdmin',
  components: {
    SupportChatAdminComponent
  },
  computed: {
    ...mapGetters('SupportRequest', {
      supportMessages: SupportGetters.GET_SUPPORT_REQUEST_MESSAGES
    })
  }
};
</script>

<style scoped></style>
