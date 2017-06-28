<template>
<header id="masthead" class="hero is-primary" role="banner" v-bind:style="styleObject">
  <div v-if="styleObject.backgroundImage" class="mask"></div>
  <div class="hero-footer">
    <h1 v-if="titles.title">{{titles.title}}</h1>
    <h2 v-if="titles.subtitle">{{titles.subtitle}}</h2>
    <h4 v-if="titles.subsubtitle">{{titles.subsubtitle}}</h4>
  </div>
</header>
</template>

<script>
export default {
  name: 'Hero',
  props: {
    images: {
      type: Object,
      required: false
    },
    titles: {
      type: Object,
      required: false
    }
  },
  data() {
    let backgroundImage = null,
      width = window.innerWidth;

    if (width < 769 && this.images.mobile_image) {
      backgroundImage = `url(${this.images.mobile_image})`;
    }

    if (width >= 769 && width < 1000 && this.images.tablet_image) {
      backgroundImage = `url(${this.images.tablet_image})`;
    }

    if (width >= 1000 && this.images.desktop_image) {
      backgroundImage = `url(${this.images.desktop_image})`;
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
#masthead {
    height: 60vh;
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
        left: 20px;
        bottom: 20px;
        width: calc(100% - 20px);
        text-align: center;
        @media(min-width: 769px) {
            text-align: left;
        }
    }
}
</style>
