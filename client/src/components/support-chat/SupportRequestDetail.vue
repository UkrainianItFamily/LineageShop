<template>
  <div class="collapsible-sidebar-body">
    <dl class="request-details">
      <dt>Инициатор</dt>
      <RouterLink
        :to="{ name: 'UserProfile', params: { id: support.authorId } }"
      >
        <dd>{{ support.login }}</dd>
      </RouterLink>
      <dt>Адрес эл. почты указанный при создании</dt>
      <dd>{{ support.email }}</dd>
      <dt>Создан</dt>
      <dd>
        <time data-datetime="date">
          {{ new Date(support.createdAt).toLocaleDateString() }}
        </time>
      </dd>
      <dt>Последнее обновление</dt>
      <dd>
        <time data-datetime="date">
          {{ new Date(support.updatedAt).toLocaleDateString() }}
        </time>
      </dd>
    </dl>

    <dl class="request-details">
      <dt>ID</dt>
      <dd>#{{ support.id }}</dd>

      <dt>Статус</dt>
      <dd>
        <span
          class="status-label status-label-answered"
          title="Мы ждем от вас ответа"
        >
          {{ support.status.label }}
        </span>
      </dd>

      <dt>Тема</dt>
      <dd>
        {{ support.subject.label }}
      </dd>

      <dt>Ваше имя (логин) на BucksTrade</dt>
      <dd>
        {{ support.login }}
      </dd>

      <dt>Номер заказа</dt>
      <dd>
        {{ support.order_id ? support.order_id : '-' }}
      </dd>
    </dl>
  </div>
</template>
<script>
export default {
  name: 'SupportRequestDetail',
  props: {
    support: {
      id: Number,
      subject: {
        id: Number,
        label: String
      },
      authorId: Number,
      login: Object,
      status: {
        id: Number,
        label: String
      },
      createdAt: String,
      order_id: Number,
      updatedAt: String
    }
  }
};
</script>
