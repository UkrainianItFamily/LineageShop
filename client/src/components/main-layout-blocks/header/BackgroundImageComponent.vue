<template>
  <div class="image-wrapper">
    <div class="image-inner">
      <img alt="bg-image" class="bg-image" src="@/assets/lineage_2.jpg" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'BackgroundImageComponent'
};
</script>

<style scoped>
.image-inner {
  width: 715px;
  height: 715px;
  position: absolute;
  z-index: 0;
  right: 50%;
  margin-right: 342px;
  bottom: 100%;
  margin-bottom: -293px;
  border-radius: 500px;
  overflow: hidden;
  background-color: #000000;
}
.bg-image {
  position: absolute;
  z-index: 100;
  display: inline-block;
  max-width: 100%;
  opacity: 0.5;
}
</style>
