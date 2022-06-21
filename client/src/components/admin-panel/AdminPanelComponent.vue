<template>
  <div>
    <BListGroup class="mb-3">
      <BListGroupItem>
        <RouterLink :to="{ name: 'UserAdminPanel' }">Пользователи</RouterLink>
      </BListGroupItem>
      <BListGroupItem>
        <RouterLink :to="{ name: 'OrderAdminPanel' }">Заказы</RouterLink>
      </BListGroupItem>
      <BListGroupItem>
        <RouterLink :to="{ name: 'SupportAdminPanel' }">
          Запросы в тех. поддержку
        </RouterLink>
      </BListGroupItem>
      <BListGroupItem>
        <RouterLink :to="{ name: 'FinanceOperationAdminPanel' }">
          История финансовых операций
        </RouterLink>
      </BListGroupItem>
    </BListGroup>
    <RouterView></RouterView>
  </div>
</template>

<script>
export default {
  name: 'AdminPanelComponent'
};
</script>

<style scoped></style>
