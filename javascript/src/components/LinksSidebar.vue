<template>
<aside id="links-sidebar" class="column is-4">
  <div class="card">
    <header class="card-header">
      <h3 class="card-header-title">
        {{title}}
      </h3>
    </header>
    <ul>
      <li v-for="link in links" class="has-text-centered" :class="{'is-active': isActive(link.url)}">
        <sidebar-link :link="link" :key="link.title"></sidebar-link>
      </li>
    </ul>
  </div>
  <div class="has-margin-top-lg">
    <a :href="button_links.box_office_url" target="_blank" class="button is-medium is-primary" style="display: block;">
          Buy Tickets
        </a>
  </div>
  <div class="has-margin-top-lg">
    <a :href="button_links.donate_url" target="_blank" class="button is-medium is-primary" style="display: block;">
          Donate
        </a>
  </div>
  <div class="has-margin-top-lg">
    <a :href="button_links.newsletter_url" target="_blank" class="button is-medium is-primary" style="display: block;">
          Join Our Mailing List
        </a>
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
    },
    button_links: Object
  },
  components: {
    SidebarLink
  },
  methods: {
    isActive(url) {
      return window.location.href === url
    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';

#links-sidebar {
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 0;
    & > .card {
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
        li.is-active {
            background-color: transparentize($primary-color, .7);
        }
    }
}
</style>
