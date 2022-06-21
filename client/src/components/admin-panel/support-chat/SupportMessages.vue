<template>
  <div class="collapsible-sidebar-body">
    <div class="comment-list">
      <div v-for="(message, key) in supportMessages" :key="key">
        <div class="comment-wrapper">
          <div class="comment-info">
            <div class="comment-author">
              <BRow v-if="message.user.id !== authUser.id" class="mt-3">
                <div
                  class="avatar comment-avatar text-center position-relative mx-2"
                >
                  <BImg
                    rounded="circle"
                    width="60"
                    :src="
                      message.user.userPhoto
                        ? message.user.userPhoto
                        : 'https://secure.gravatar.com/avatar/71a8476877076b4204d92b670c4b2979?default=https%3A%2F%2Fassets.zendesk.com%2Fhc%2Fassets%2Fdefault_avatar.png&amp;r=g'
                    "
                    alt=""
                    class="user-avatar"
                  />
                  <div class="mt-1 mx-2">
                    <span>
                      {{ message.user.login }}
                    </span>
                  </div>
                </div>
                <div class="innerMessage">
                  <section class="comment-body pb-1">
                    <div class="zd-comment" dir="auto">
                      <p dir="auto">{{ message.text }}</p>
                    </div>
                  </section>
                  <div
                    class="comment-meta position-absolute createdAt messageDate"
                  >
                    <span>
                      {{ message.createdAt }}
                    </span>
                  </div>
                </div>
              </BRow>
              <BRow class="flex-row-reverse mt-3" v-else>
                <div
                  class="avatar comment-avatar text-center position-relative mx-2"
                >
                  <BImg
                    rounded="circle"
                    width="60"
                    :src="
                      message.user.userPhoto
                        ? message.user.userPhoto
                        : 'https://secure.gravatar.com/avatar/71a8476877076b4204d92b670c4b2979?default=https%3A%2F%2Fassets.zendesk.com%2Fhc%2Fassets%2Fdefault_avatar.png&amp;r=g'
                    "
                    alt=""
                    class="user-avatar"
                  />
                  <div class="mt-1 mx-2">
                    <span>
                      {{ message.user.login }}
                    </span>
                  </div>
                </div>
                <div class="outerMessage">
                  <span class="messageText">{{ message.text }}</span>
                  <div
                    class="comment-meta position-absolute createdAt messageDate"
                  >
                    <span>
                      {{ message.createdAt }}
                    </span>
                  </div>
                </div>
              </BRow>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import * as authGetters from '@/store/modules/auth/types/getters';
import * as authActions from '@/store/modules/auth/types/actions';

export default {
  name: 'SupportMessages',
  props: {
    supportMessages: Object
  },
  computed: {
    ...mapGetters('AuthService', {
      authUser: authGetters.GET_LOGGED_USER
    })
  },
  methods: {
    ...mapActions('AuthService', {
      fetchAuthUser: authActions.FETCH_LOGGED_USER
    })
  },
  mounted() {
    this.fetchAuthUser();
  }
};
</script>
<style scoped>
.innerMessage,
.outerMessage {
  display: flex;
  background: rgba(141, 181, 224, 0.98);
  border-radius: 18px;
  position: relative;
  color: #ffffff;
  padding: 15px;
  min-width: 15%;
  max-width: 75%;
}

.messageDate {
  bottom: 5px;
  right: 10px;
}

.outerMessage {
  background: rgba(216, 229, 243, 0.98);
  color: #000000;
}
</style>
