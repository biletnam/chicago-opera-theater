<template>
<aside id="links-sidebar" class="column is-4">
  <div class="card">
    <header class="card-header">
      <h3 class="card-header-title">
        {{title}}
      </h3>
    </header>
    <ul>
      <sidebar-link v-for="link in links" :link="link" :key="link.title"></sidebar-link>
    </ul>
  </div>
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
  components: {
    SidebarLink
  }
}
</script>

<style lang="scss" scoped>@import '~variables';

#links-sidebar {
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 0;
    & > .card {
        border: 2px solid $primary-color;
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 0;
        .card-header {
            box-shadow: none;
            border-bottom: 1px solid transparentize($primary-color, .5);
        }
        li {
            padding: 0;
        }
        li:not(:last-of-type) {
            border-bottom: 1px solid transparentize($primary-color, .5);
        }
    }
}
</style>
