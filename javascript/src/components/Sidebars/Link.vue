<template>
<div>
  <a v-if="!active" :href="link.url" class="has-arrow-icon">
      {{link.title}}
      <b-icon
          pack="fa"
          icon="arrow-right">
      </b-icon>
    </a>
  <p v-else>
    {{link.title}}
  </p>
</div>
</template>

<script>
export default {
  name: 'Link',
  props: {
    link: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      active: window.location.href === this.link.url
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
p {
    font-weight: 600;
    padding: 0.75em;
    display: block;
}

li.is-active {
    p {
        color: $primary-color;
    }
}
</style>
