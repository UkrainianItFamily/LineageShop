<template>
  <div class="p-3 chat-area">
    <BRow class="d-flex justify-content-between mb-3">
      <BCol md="6">
        <RouterLink to="#" class="font-weight-bold text-dark">
          FunPay
        </RouterLink>
        <span
          class="pr-1 pl-1 bg-primary text-white rounded-lg font-weight-bold fa-xs"
          >оповещениея</span
        >
      </BCol>
      <!--      <BCol md="6">-->
      <!--        <div class="text-secondary text-right">24.01.2021</div>-->
      <!--      </BCol>-->
      <BRow>
        <BCol md="12">
          <BAlert show variant="secondary" class="mr-3 ml-3 p-3 d-flex">
            <FontAwesomeIcon
              class="text-primary mr-3"
              :icon="['fa', 'info-circle']"
              size="lg"
            />
            <div>
              Уважаемые продавцы,
              <strong>Не доверяйте сообщениям в чате!</strong> Перед выполнением
              заказа <strong>всегда проверяйте наличие оплаты</strong> в разделе
              "<RouterLink to="#">Mои продажы</RouterLink>".
            </div>
          </BAlert>
        </BCol>
      </BRow>
    </BRow>

    <!--    <BRow-->
    <!--      class="mb-3 pt-3 d-flex justify-content-center align-items-center position-relative"-->
    <!--    >-->
    <!--      <div class="pr-2 pl-2 bg-white text-secondary position-absolute">-->
    <!--        24 января-->
    <!--      </div>-->
    <!--      <span class="border-bottom w-100 bg-secondary"></span>-->
    <!--    </BRow>-->

    <BRow
      class="d-flex justify-content-between mb-3"
      v-for="message in messages"
      :key="message.id"
    >
      <BCol md="6">
        <RouterLink to="#" class="font-weight-bold text-dark">
          {{ message.authorUser.login }}
        </RouterLink>
      </BCol>
      <BCol md="6">
        <div class="text-secondary text-right">
          {{ message.createdAt | moment('DD.MM.YYYY') }}
        </div>
      </BCol>
      <BRow>
        <BCol md="12">
          <div v-if="message.hiddenStatus" class="text-secondary pl-3 pr-3">
            Сообщение скрыто
          </div>
          <div v-else class="pl-3 pr-3 message">{{ message.message }}</div>
        </BCol>
      </BRow>
    </BRow>
  </div>
</template>

<script>
export default {
  name: 'MessagesListComponent',
  props: {
    messages: Object
  }
};
</script>

<style scoped>
.chat-area {
  overflow-x: hidden;
  overflow-y: auto;
}

.message {
  white-space: pre-wrap;
}
</style>
