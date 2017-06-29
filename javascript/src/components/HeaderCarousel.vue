<template>
<header id="header-carousel" class="swiper-container" role="banner">
  <div class="swiper-wrapper">
    <panel v-for="panel in panels" :key="panel.title" class="swiper-slide" :images="images(panel)" :titles="titles(panel)" :text_color="panel.text_color" :mask_color="panel.mask_color" :links="panel.links"></panel>
  </div>
  <div class="swiper-button-prev swiper-button-white"></div>
  <div class="swiper-button-next swiper-button-white"></div>
</header>
</template>

<script>
import Panel from '~Vue/Hero/Panel';
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
  },
  methods: {
    images(panel) {
      return {
        desktop_image: panel.desktop_image,
        tablet_image: panel.tablet_image,
        mobile_image: panel.mobile_image,
      }
    },
    titles(panel) {
      return {
        title: panel.title,
        subtitle: panel.subtitle,
        subsubtitle: panel.subsubtitle,
      }
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
.swiper-container {
    width: 100%;
}
</style>
