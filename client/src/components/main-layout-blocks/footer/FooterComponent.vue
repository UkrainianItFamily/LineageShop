<template>
  <footer>
    <BContainer class="border-top pt-3">
      <BRow align-h="between">
        <BCol sm="6" xs="12">
          <div class="d-flex justify-content-start align-items-center">
            <div class="copyright">© 2015–2021 FunPay</div>
            <div class="footer-feedback ml-3">
              <RouterLink
                :to="{ name: 'SupportRequest' }"
                target="_blank"
                rel="nofollow"
                >Отправить запрос</RouterLink
              >
            </div>
          </div>
        </BCol>
        <BCol sm="6" xs="12">
          <div class="d-flex justify-content-end align-items-center">
            <div class="ml-auto">
              <RouterLink to="#" class="vk-icon bg-light p-2 rounded-circle">
                <FontAwesomeIcon :icon="['fab', 'vk']" size="lg" />
              </RouterLink>
            </div>
            <div class="ml-3">РАЗРАБОТАНО</div>
          </div>
        </BCol>
      </BRow>
    </BContainer>
  </footer>
</template>

<script>
export default {
  name: 'FooterComponent'
};
</script>

<style scoped></style>
