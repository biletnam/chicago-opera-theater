<template>
<div class="card">
  <header class="card-header">
    <h4 class="card-header-title">
      {{event.event_title}}
    </h4>
  </header>
  <div class="card-content">
    <div>
      <ul>
        <li v-for="date in event.event_dates">
          <p>
            {{date.date}}
          </p>
        </li>
      </ul>
    </div>
  </div>
  <footer class="card-footer">
    <sidebar-link class="card-footer-item" :link="{title: 'Read more', url: event.link}"></sidebar-link>
  </footer>
</div>
</template>

<script>
import SidebarLink from '~Vue/Sidebars/Link';
export default {
  name: 'Event',
  props: {
    event: {
      type: Object,
      required: true
    }
  },
  components: {
    SidebarLink
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
li {
    padding: 0.25em;
}
</style>
