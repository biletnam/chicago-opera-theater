<template>
<header id="masthead" class="hero is-primary" role="banner" :style="headerStyleObject">
  <div v-if="headerStyleObject.backgroundImage" class="mask" :style="maskStyleObject"></div>
  <div class="hero-footer">
    <h1 v-if="titles.title" :style="textStyleObject">{{titles.title}}</h1>
    <h2 v-if="titles.subtitle" :style="textStyleObject">{{titles.subtitle}}</h2>
    <h4 v-if="titles.subsubtitle" :style="textStyleObject">{{titles.subsubtitle}}</h4>
  </div>
</header>
</template>

<script>
import chroma from 'chroma-js';
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
    },
    text_color: {
      type: String,
      required: false
    },
    mask_color: {
      type: String,
      required: false
    }
  },
  data() {
    let backgroundImage = null,
      backgroundColor = null,
      color = null,
      width = window.innerWidth;

    if (this.text_color) {
      color = this.text_color;
    }

    if (this.mask_color) {
      backgroundColor = `rgba(${chroma(this.mask_color).alpha(.5).rgba().join(',')})`;
    }

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
      headerStyleObject: {
        backgroundImage
      },
      maskStyleObject: {
        backgroundColor
      },
      textStyleObject: {
        color
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
