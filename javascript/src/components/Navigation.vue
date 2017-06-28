<template>
<nav id="navigation" class="nav" role="navigation">
  <div class="nav-left">
    <div class="nav-item">
      <a href="/"><img :src="image" alt="Chicago Opera Theater Logo" /></a>
    </div>
  </div>
  <span :class="{'nav-toggle': true, 'is-active': mobileVisible}" @click="mobileVisible = !mobileVisible">
    <span></span>
  <span></span>
  <span></span>
  </span>
  <div :class="{'nav-right nav-menu': true, 'is-active': mobileVisible}" style="overflow: visible">
    <navigation-link v-for="(link, index) in links" :link="link" :index="index" :key="link.id"></navigation-link>
  </div>
</nav>
</template>

<script>
import NavigationLink from '~Vue/Navigation/NavigationLink';

export default {
  name: "Navigation",
  props: {
    links: {
      type: Array,
      required: true
    },
    image: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      mobileVisible: false,
    }
  },
  components: {
    NavigationLink
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
#navigation {
    background: $navigation-background;
    height: $navigation-height;

    .nav-toggle {
        span {
            background-color: $primary-color;
        }
    }
}
</style>
