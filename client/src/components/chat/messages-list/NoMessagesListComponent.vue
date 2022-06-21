<template>
  <div class="p-3 chat-empty">
    <div class="chat-not-selected-info">
      <span class="bookmarks-nonempty">
        Выберите диалог слева.<br />
        Уверены, у вас всё получится.
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NoMessagesListComponent'
};
</script>

<style scoped lang="scss">
.chat-empty {
  padding: 0 20px;
  overflow-x: hidden;
  overflow-y: auto;
  display: flex;
  align-items: center;
  text-align: center;

  .chat-not-selected-info {
    margin: auto;
    color: #a6a6a6;

    span {
      display: block;
      margin-top: 10px;
    }
  }
}
</style>
