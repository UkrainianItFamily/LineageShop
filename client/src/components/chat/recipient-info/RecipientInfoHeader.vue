<template>
  <div class="border-bottom">
    <BCol md="8" class="d-flex justify-content-start p-3">
      <BAvatar :src="recipientUser.userPhoto" class="mr-3"></BAvatar>
      <div>
        <strong>{{ recipientUser.login }}</strong>
        <div class="text-secondary">{{ statusOnline }}</div>
      </div>
    </BCol>
    <!--      <BCol md="4" class="d-flex justify-content-end p-3">-->
    <!--        <BButton class="bg-light border-0">-->
    <!--          <div class="fa-xs text-primary">-->
    <!--            <FontAwesomeIcon-->
    <!--              class="text-primary mr-1"-->
    <!--              :icon="['fa', 'bell']"-->
    <!--              size="lg"-->
    <!--            />-->
    <!--            Включить оповещения-->
    <!--          </div>-->
    <!--        </BButton>-->
    <!--        <BButton class="bg-light border-0 ml-3">-->
    <!--          <FontAwesomeIcon-->
    <!--            class="text-primary"-->
    <!--            :icon="['fas', 'exclamation-triangle']"-->
    <!--            size="x"-->
    <!--          />-->
    <!--        </BButton>-->
    <!--      </BCol>-->
  </div>
</template>

<script>
export default {
  name: 'RecipientInfoHeader',
  props: {
    recipientUser: {
      id: Number,
      login: String,
      online: Boolean,
      userPhoto: String
    }
  },
  computed: {
    statusOnline() {
      if (this.recipientUser.online) {
        return 'Online';
      }

      return 'Offline';
    }
  }
};
</script>

<style scoped></style>
