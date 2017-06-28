<template>
<b-dropdown :position="position" :class="{'nav-item': true, 'is-active': active}">
  <a class="link-title" slot="trigger">{{link.title}}</a>
  <template v-for="child in link.children">
  <b-dropdown-option :key="child.id" has-link>
    <a :href="child.url">{{child.title}}</a>
  </b-dropdown-option>
  <b-dropdown-option separator />
</template>
</b-dropdown>
</template>

<script>
export default {
  name: 'NavigationLink',
  props: {
    link: {
      type: Object,
      required: true,
    },
    index: {}
  },
  data() {
    let position = 'is-bottom-right';
    if (this.index > 2) {
      position = 'is-bottom-left';
    }
    return {
      active: false,
      position
    }
  },
  methods: {
    childActive() {
      this.link.children.forEach(child => {
        if (window.location.href === child.url) {
          this.active = true;
        }
      });
    }
  },
  mounted() {
    this.childActive();
  }
}
</script>

<style lang="scss">
.box.is-dropdown {
    z-index: 1000;
    min-width: 200px;
}
</style>

<style lang="scss" scoped>@import '~variables';
a.link-title {
    color: $primary-color;
    font-weight: 800;
    font-family: $family-secondary;
    font-size: 1.15em;
    &:hover {
        color: white;
    }
}

.dropdown {
    display: block;
    @media(min-width: 769px) {
        display: inline-flex;
    }
}

.nav-item {
    margin-left: 10px;
    margin-right: 10px;
    &.is-active {
        position: relative;
        background-color: $primary-color;
        a.link-title {
            color: white;
        }
    }
    @media(min-width: 769px) {
        &.is-active {
            &:after,
            &:before {
                content: '';
                position: absolute;
                top: 0;
                width: 0;
                height: 0;
                border: 0 solid transparent;
            }
        }
        &.is-active:not(:last-of-type):not(:first-of-type) {
            &:after {
                right: -20px;
                border-bottom-width: 52px;
                border-top-width: 0;
                border-left: 20px solid $primary-color;
            }
            &:before {
                left: -20px;
                border-top-width: 52px;
                border-bottom-width: 0;
                border-right: 20px solid $primary-color;
            }
        }
        &.is-active:last-of-type {
            &:before {
                left: -20px;
                border-top-width: 52px;
                border-bottom-width: 0;
                border-right: 20px solid $primary-color;
            }
        }
        &.is-active:first-of-type {
            &:after {
                right: -20px;
                border-bottom-width: 52px;
                border-top-width: 0;
                border-left: 20px solid $primary-color;
            }
        }
    }
}
</style>
