<template>
<div>
  <a v-if="!active" :href="link.url">
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
a,
p {
    font-weight: 600;
    padding: 0.75em;
    display: block;
}

a {
    margin-left: calc(10px + 1.5rem);
    transition: margin-left 0.3s;
    .icon {
        margin-left: 10px;
        transition: opacity 0.3s;
        opacity: 0;
    }
    &:hover {
        color: $primary-color;
        margin-left: 0;
        .icon {
            opacity: 1;
        }
    }
}

li.is-active {
    p {
        color: $primary-color;
    }
}
</style>
