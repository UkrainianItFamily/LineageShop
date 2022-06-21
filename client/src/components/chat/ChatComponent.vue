<template>
  <BRow>
    <BCol md="3">
      <BRow class="chat-title border-bottom">
        <div class="page-header page-header-no-hr p-3 m-auto text-center">
          Сообщения
        </div>
      </BRow>
      <ChatsListComponent :chats="chats"></ChatsListComponent>
    </BCol>
    <BCol
      md="6"
      class="border-right border-left p-0 d-flex flex-column justify-content-between chat-main-area"
    >
      <RecipientInfoHeader
        v-if="chatId"
        :recipientUser="chat.recipientUser"
      ></RecipientInfoHeader>
      <MessagesListComponent
        v-if="chatId"
        :messages="messages"
      ></MessagesListComponent>
      <NoMessagesListComponent v-else></NoMessagesListComponent>
      <div class="position-relative">
        <BRow
          class="border-top m-0 d-flex align-items-center justify-content-end message-area"
        >
          <BCol cols="11">
            <BRow>
              <BFormTextarea
                v-on:keyup.ctrl.enter="onAddMessage"
                v-model="message"
                rows="3"
                placeholder="Написать..."
                no-resize
                class="border-0 border-top rounded-0 shadow-none"
              ></BFormTextarea>
            </BRow>
          </BCol>
          <BCol cols="1">
            <BRow>
              <!--                  <RouterLink to="#" class="text-secondary ml-2 mr-2">-->
              <!--                    <FontAwesomeIcon :icon="['fas', 'paperclip']" size="2x" />-->
              <!--                  </RouterLink>-->
              <FontAwesomeIcon
                :icon="['fas', 'arrow-right']"
                size="2x"
                v-on:click="onAddMessage"
              />
            </BRow>
          </BCol>
        </BRow></div
    ></BCol>
    <BCol md="3">
      <RecipientInfoRightCol
        v-if="chatId"
        :userCreatedAt="chat.recipientUser.createdAt"
      ></RecipientInfoRightCol
    ></BCol>
  </BRow>
</template>

<script>
import MessagesListComponent from '@/components/chat/messages-list/MessagesListComponent';
import ChatsListComponent from '@/components/chat/chats-list/ChatsListComponent';
import RecipientInfoHeader from '@/components/chat/recipient-info/RecipientInfoHeader';
import RecipientInfoRightCol from '@/components/chat/recipient-info/RecipientInfoRightCol';
import NoMessagesListComponent from '@/components/chat/messages-list/NoMessagesListComponent';
import { mapActions, mapGetters } from 'vuex';
import * as messageGetters from '@/store/modules/message/types/getters';
import * as messageActions from '@/store/modules/message/types/actions';
import * as chatGetters from '@/store/modules/chat/types/getters';
import * as chatActions from '@/store/modules/chat/types/actions';
import _ from 'lodash';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  name: 'ChatComponent',
  data: function() {
    return {
      message: ''
    };
  },
  components: {
    NoMessagesListComponent,
    RecipientInfoRightCol,
    RecipientInfoHeader,
    ChatsListComponent,
    MessagesListComponent
  },
  computed: {
    ...mapGetters('Message', {
      messages: messageGetters.GET_MESSAGES
    }),

    ...mapGetters('chat', {
      chats: chatGetters.GET_CHATS,
      chat: chatGetters.GET_CHAT
    }),

    chatId() {
      return Number(_.get(this.$route, 'params.chatId', null));
    }
  },
  methods: {
    ...mapActions('Message', {
      getMessageByChatId: messageActions.GET_MESSAGES_BY_CHAT_ID,
      addMessage: messageActions.ADD_MESSAGE
    }),

    ...mapActions('chat', {
      getChats: chatActions.GET_CHATS,
      getChat: chatActions.GET_CHAT
    }),

    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    async chatInitialize() {
      await this.getChats();
      if (this.chatId) {
        await this.getMessageByChatId(this.chatId);
        await this.getChat(this.chatId);
      }

      this.scrollToEnd();
    },

    async onAddMessage() {
      await this.addMessage({
        message: this.message,
        chatId: this.chatId
      });

      this.message = '';
    },

    scrollToEnd() {
      setTimeout(() => {
        const messagesBlock = this.$el.querySelector('.chat-area');
        messagesBlock.scrollTop = messagesBlock.scrollHeight;
      }, 500);
    }
  },
  async mounted() {
    try {
      await this.chatInitialize();
    } catch (error) {
      this.setErrorNotification(error);
    }
  },

  watch: {
    $route: 'chatInitialize'
  }
};
</script>

<style scoped>
.page-header {
  font-size: 30px;
  line-height: 1;
  font-weight: 1000;
}
.message-area {
  z-index: 1;
}

.chat-title {
  padding: 0.3rem !important;
}

.chat-main-area {
  height: 80vh;
}
</style>
