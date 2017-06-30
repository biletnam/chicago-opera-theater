<template>
<div class="hero is-primary is-large" :style="headerStyleObject">
  <div v-if="headerStyleObject.backgroundImage" class="mask" :style="maskStyleObject"></div>
  <div class="hero-body"></div>
  <div class="hero-foot">
    <div class="columns">
      <div class="column">
        <h1 v-if="titles.title" :style="textStyleObject">{{titles.title}}</h1>
        <h2 v-if="titles.subtitle" :style="textStyleObject">{{titles.subtitle}}</h2>
        <h4 v-if="titles.subsubtitle" :style="textStyleObject">{{titles.subsubtitle}}</h4>
      </div>
      <div class="column" :class="{'has-text-right': !isMobile}">
        <div class="field has-addons">
          <div v-for="link in links" class="control">
            <a class="button is-inverted is-primary" :style="{color: mask_color}" :href="link.url || link.external_url">{{link.title}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
    },
    links: {
      type: Array,
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

    if (width < 768 && this.images.mobile_image) {
      backgroundImage = `url(${this.images.mobile_image})`;
    }

    if (width >= 768 && width < 1000 && this.images.tablet_image) {
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
      },
      isMobile: window.innerWidth < 769
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
.hero {
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    @media(max-width: 768px) {
        height: 60vh;
    }

    .mask {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: darken(transparentize($primary-color, .5), 20);
        z-index: 0;
    }

    .hero-foot {
        position: relative;
        z-index: 1;
        padding: 0.75em;

        .field {
            @media(min-width: 769px) {
                position: absolute;
                bottom: 0.75em;
                right: 0.75em;
            }
            .button:hover {
                background-color: darken(white, 10);
            }
        }
    }
}
</style>