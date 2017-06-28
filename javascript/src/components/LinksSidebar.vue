<template>
<aside id="links-sidebar" class="column is-4">
  <ul>
    <li>
      <h3>{{title}}</h3>
    </li>
    <sidebar-link v-for="link in links" :link="link" :key="link.title"></sidebar-link>
  </ul>
</aside>
</template>

<script>
import SidebarLink from '~Vue/Sidebars/Link';
export default {
  name: 'LinksSidebar',
  props: {
    title: {
      type: String,
      default: 'Links'
    },
    links: {
      type: Array,
      required: true
    }
  },
  data() {
    return {

    }
  },
  components: {
    SidebarLink
  }
}
</script>

<style lang="scss" scoped>@import '~variables';

#links-sidebar {
    border: 2px solid $primary-color;
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 0;
    li {
        padding: 0;
    }
    li:first-of-type {
        padding: 0.25em 0.75em 1em;
    }
    li:not(:last-of-type) {
        border-bottom: 1px solid transparentize($primary-color, .5);
    }
}
</style>
