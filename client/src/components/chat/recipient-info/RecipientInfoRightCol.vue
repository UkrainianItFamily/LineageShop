<template>
  <BCol md="3" class="pt-3 pr-5 pl-5">
    <div class="text-secondary">Дата регистрации</div>
    <div>
      {{ userCreatedAt | moment('DD MMMM YYYY, H:MM, ') }}
      {{ userCreatedAt | moment('from') }}
    </div>
  </BCol>
</template>

<script>
export default {
  name: 'RecipientInfoRightCol',
  props: {
    userCreatedAt: String
  }
};
</script>

<style scoped></style>
