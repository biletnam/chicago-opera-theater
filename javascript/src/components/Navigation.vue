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
    <template v-for="(link, index) in links">
      <navigation-link v-if="link.children.length > 0" :link="link" :index="index" :key="link.id"></navigation-link>
      <span v-else class="nav-item control dropdown" :class="{'is-active': isActive(link.url)}">
        <a :href="link.url" class="link-title">{{link.title}}</a>
      </span>

</template>
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
  },
  methods: {
    isActive(url) {
      if (window.location.href === url) {
        this.active = true;
      }
    }
  }
}

</script>

<style lang="scss">@import '~variables';
#navigation {
    background: $navigation-background;
    height: $navigation-height;

    .nav-toggle {
        @include tablet {
             @include hamburger($navigation-height);
        }
        span {
            background-color: $primary-color;
        }
        @media (min-width: 1100px) {
            display: none;
        }
    }

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
        @media (min-width: 1100px) {
            display: inline-flex;
        }
    }

    .nav-menu {
        @media (max-width: 1100px) {
            &.nav-right {
                background-color: white;
                box-shadow: 0 4px 7px rgba(hsl(0, 0%, 4%), 0.1);
                left: 0;
                display: none;
                right: 0;
                top: 100%;
                position: absolute;
                .nav-item {
                    border-top: 1px solid rgba(hsl(0, 0%, 86%), 0.5);
                    padding: 0.75rem;
                }
                &.is-active {
                    display: block;
                }
            }
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
        @media (min-width: 1100px) {
            &:after,
            &:before {
                content: '';
                position: absolute;
                top: 0;
                width: 0;
                height: 0;
                border: 0 solid transparent;
                transition: all 0.2s;
            }
            &:not(:last-of-type):not(:first-of-type) {
                &:after {
                    right: -20px;
                    border-bottom-width: $navigation-height;
                    border-top-width: 0;
                    border-left: 0 solid transparent;
                }
                &:before {
                    left: -20px;
                    border-top-width: $navigation-height;
                    border-bottom-width: 0;
                    border-right: 0 solid transparent;
                }
            }
            &:last-of-type {
                &:before {
                    left: -20px;
                    border-top-width: $navigation-height;
                    border-bottom-width: 0;
                    border-right: 0 solid transparent;
                }
            }
            &:first-of-type {
                &:after {
                    right: -20px;
                    border-bottom-width: $navigation-height;
                    border-top-width: 0;
                    border-left: 0 solid transparent;
                }
            }
            &.is-active:not(:last-of-type):not(:first-of-type) {
                &:after {
                    border-left: 20px solid $primary-color;
                }
                &:before {
                    border-right: 20px solid $primary-color;
                }
            }
            &.is-active:last-of-type {
                &:before {
                    border-right: 20px solid $primary-color;
                }
            }
            &.is-active:first-of-type {
                &:after {
                    border-left: 20px solid $primary-color;
                }
            }
            $amount: 0.5;
            &:hover {
                cursor: pointer;
                a.link-title {
                    color: white;
                }
            }
            &:hover:not(.is-active) {
                background-color: transparentize($primary-color, $amount);
            }
            &:hover:not(.is-active):not(:last-of-type):not(:first-of-type) {
                &:after {
                    border-left: 20px solid transparentize($primary-color, $amount);
                }
                &:before {
                    border-right: 20px solid transparentize($primary-color, $amount);
                }
            }
            &:hover:not(.is-active):last-of-type {
                &:before {
                    border-right: 20px solid transparentize($primary-color, $amount);
                }
            }
            &:hover:not(.is-active):first-of-type {
                &:after {
                    border-left: 20px solid transparentize($primary-color, $amount);
                }
            }
        }
    }
}
</style>
