<template>
  <div class="mb-4 mt-4">
    <h5 class="unique-font">
      Имя персонажа
    </h5>
    <div>
      <BFormInput
        v-model="nickname"
        @input="setNickname"
        class="shadow-none"
      ></BFormInput>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NicknameField',
  data() {
    return {
      nickname: ''
    };
  },
  methods: {
    setNickname() {
      this.$emit('getNickname', this.nickname);
    }
  }
};
</script>

<style scoped></style>
