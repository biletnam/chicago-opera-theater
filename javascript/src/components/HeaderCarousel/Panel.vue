<template>
<div class="hero is-primary swiper-slide" :style="styleObject">
  <div v-if="styleObject.backgroundImage" class="mask"></div>
  <div class="hero-footer">
    <h1 v-if="panel.title">{{panel.title}}</h1>
    <h2 v-if="panel.subtitle">{{panel.subtitle}}</h2>
    <h4 v-if="panel.subsubtitle">{{panel.subsubtitle}}</h4>
  </div>
</div>
</template>

<script>
export default {
  name: 'Panel',
  props: {
    panel: {
      type: Object,
      required: true
    }
  },
  data() {
    let backgroundImage = null,
      width = window.innerWidth;

    if (width < 769 && this.panel.mobile_image) {
      backgroundImage = `url(${this.panel.mobile_image})`;
    }

    if (width >= 769 && width < 1000 && this.panel.tablet_image) {
      backgroundImage = `url(${this.panel.tablet_image})`;
    }

    if (width >= 1000 && this.panel.desktop_image) {
      backgroundImage = `url(${this.panel.desktop_image})`;
    }
    return {
      styleObject: {
        backgroundImage
      }
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
.hero {
    height: 100%;
    width: 100%;
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

    .mask {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: darken(transparentize($primary-color, .5), 20);
    }

    .hero-footer {
        position: absolute;
        left: 0;
        bottom: 20px;
        width: 100%;
        text-align: center;
        @media(min-width: 769px) {
            text-align: left;
            left: 20px;
            width: calc(100% - 20px);
        }
    }
}
</style>
