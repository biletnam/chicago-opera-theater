<template>
<a :href="url()" :class="{'has-arrow-icon': !active}">
    {{link.title}}
    <b-icon
      v-if="!active"
      :icon="link.icon || 'arrow-right'">
    </b-icon>
  </a>
</template>

<script>
export default {
  name: 'Link',
  props: {
    link: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      active: window.location.href === this.link.url
    }
  },
  methods: {
    url() {
      if (!this.active) {
        return this.link.url;
      } else {
        return '';
      }
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
a:not(.card-footer-item) {
    display: block;
}
*:not(.card-footer-item) > a {
    padding: 0.75em;
    font-weight: 600;
}

li.is-active {
    a {
        color: $primary-color;
    }
}
</style>
