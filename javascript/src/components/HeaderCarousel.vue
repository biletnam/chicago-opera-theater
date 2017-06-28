<template>
<header id="header-carousel" class="swiper-container" role="banner">
  <div class="swiper-wrapper">
    <panel v-for="panel in panels" :panel="panel" :key="panel.title"></panel>
  </div>
  <div class="swiper-button-prev swiper-button-white"></div>
  <div class="swiper-button-next swiper-button-white"></div>
</header>
</template>

<script>
import Panel from '~Vue/HeaderCarousel/Panel';
const Swiper = require('swiper/dist/js/swiper');
export default {
  name: 'HeaderCarousel',
  props: {
    panels: {
      type: Array,
      required: true
    }
  },
  components: {
    Panel
  },
  mounted() {
    const mySwiper = new Swiper('.swiper-container', {
      loop: true,
      speed: 500,
      autoplay: 7000,
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
    });
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
.swiper-container {
    height: 60vh;
    width: 100%;
}
</style>
