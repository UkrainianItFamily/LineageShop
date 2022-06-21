<template>
  <BRow>
    <div
      class="chat-block border rounded-lg d-flex flex-column justify-content-between"
    >
      <div
        class="chat-header border-bottom d-flex justify-content-between align-items-center"
      >
        <div class="chat-user d-flex align-items-center">
          <div
            class="chat-user-photo user-photo rounded-circle overflow-hidden d-inline-block m-3"
          >
            <AvatarComponent
              v-if="user"
              :userPhoto="user.userPhoto"
            ></AvatarComponent>
          </div>
          <div>
            <RouterLink
              v-if="user"
              :to="{ name: 'UserProfile', params: { id: user.id } }"
              class="chat-user-name text-dark font-weight-bold align-text-top"
              >{{ user.login }}
            </RouterLink>
            <span
              v-if="user"
              :class="`text-${user.onlineStatus.variant} font-weight-bold pt-3`"
              >{{ user.onlineStatus.text }}</span
            >
          </div>
        </div>
        <div class="chat-control d-flex justify-content-end m-3">
          <!--          <BButton class="bg-light border-0">-->
          <!--            <FontAwesomeIcon-->
          <!--              class="text-primary"-->
          <!--              :icon="['far', 'clone']"-->
          <!--              size="1x"-->
          <!--            />-->
          <!--          </BButton>-->
          <!--          <BButton-->
          <!--            class="bg-light border-0 ml-2 w-50 d-flex align-items-center text-primary p-2"-->
          <!--          >-->
          <!--            <div class="mr-2">-->
          <!--              <FontAwesomeIcon-->
          <!--                class="text-primary mr-1"-->
          <!--                :icon="['fas', 'bell']"-->
          <!--                size="1x"-->
          <!--              />-->
          <!--            </div>-->
          <!--            <div class="fa-xs text-left">Включить оповещения</div>-->
          <!--          </BButton>-->
          <!--          <BButton class="bg-light border-0 ml-2">-->
          <!--            <FontAwesomeIcon-->
          <!--              class="text-primary"-->
          <!--              :icon="['fas', 'exclamation-triangle']"-->
          <!--              size="1x"-->
          <!--            />-->
          <!--          </BButton>-->
        </div>
      </div>
      <MessagesListComponent v-if="chat.id" :messages="messages">
      </MessagesListComponent>
      <ChatUserSellerRatingComponent
        v-else
        :userRatings="userRatings"
      ></ChatUserSellerRatingComponent>
      <div class="chat-input">
        <div class="position-relative">
          <BRow
            class="border-top m-0 d-flex align-items-center justify-content-end message-area"
          >
            <BCol cols="10">
              <BRow>
                <BFormTextarea
                  @keyup.ctrl.enter="onAddMessage"
                  v-model="message"
                  rows="3"
                  placeholder="Написать..."
                  no-resize
                  class="border-0 border-top rounded-0 shadow-none"
                ></BFormTextarea> </BRow
            ></BCol>
            <BCol cols="2">
              <BRow>
                <BButton
                  @click="debounceOnAddMessage"
                  variant="white"
                  class="shadow-none"
                >
                  <FontAwesomeIcon :icon="['fas', 'arrow-right']" size="2x" />
                </BButton>
              </BRow>
            </BCol>
          </BRow>
        </div>
      </div>
    </div>
  </BRow>
</template>

<script>
import AvatarComponent from '@/components/user-profile/AvatarComponent';
import MessagesListComponent from '@/components/chat/messages-list/MessagesListComponent';
import ChatUserSellerRatingComponent from '@/components/chat/messages-list/ChatUserSellerRatingComponent';
import * as messageGetters from '@/store/modules/message/types/getters';
import * as messageActions from '@/store/modules/message/types/actions';
import * as chatGetters from '@/store/modules/chat/types/getters';
import * as chatActions from '@/store/modules/chat/types/actions';
import * as notificationActions from '@/store/modules/notification/types/actions';
import { mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  name: 'ChatComponent',

  components: {
    AvatarComponent,
    MessagesListComponent,
    ChatUserSellerRatingComponent
  },
  data: function() {
    return {
      debounceOnAddMessage: _.debounce(() => {
        this.onAddMessage();
      }, 1000),
      message: ''
    };
  },
  props: {
    userRatings: Object,
    user: {
      id: Number,
      login: String,
      onlineStatus: {
        text: String,
        variant: String
      },
      userPhoto: String
    }
  },
  computed: {
    ...mapGetters('Message', {
      messages: messageGetters.GET_MESSAGES
    }),
    ...mapGetters('chat', {
      chat: chatGetters.GET_CHAT
    })
  },
  methods: {
    ...mapActions('Message', {
      getMessageByChatId: messageActions.GET_MESSAGES_BY_CHAT_ID,
      addMessage: messageActions.ADD_MESSAGE
    }),
    ...mapActions('chat', {
      getChatByUserId: chatActions.GET_CHAT_BY_USER_ID,
      addChat: chatActions.ADD_CHAT
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION,
      setSuccessNotification: notificationActions.SET_SUCCESS_NOTIFICATION
    }),
    async onAddMessage() {
      if (!this.chat.id) {
        await this.addChat({ recipientUserId: this.user.id });
        await this.setSuccessNotification('Чат успешно создан');
        await this.getMessageByChatId(this.chat.id);
      }
      await this.addMessage({
        message: this.message,
        chatId: this.chat.id
      });

      this.message = '';
    }
  }
};
</script>

<style scoped>
.chat-block {
  width: 100%;
  height: 700px;
}
</style>
