<template>
<header id="masthead" role="banner">
  <panel :images="images" :titles="titles" :text_color="text_color" :mask_color="mask_color" :links="links" :primary-link="primaryLink"></panel>
</header>

</template>

<script>
import Panel from '~Vue/Hero/Panel';
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
    },
    primaryLink: {
      type: String,
      required: false
    }
  },
  components: {
    Panel
  }
}

</script>
