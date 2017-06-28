<template>
<aside id="events-sidebar" class="column is-4">
  <div class="card">
    <header class="card-header">
      <h3 class="card-header-title">
        {{title}}
      </h3>
    </header>
    <div class="card-content">
      <sidebar-event v-for="event in events" :event="event" :key="event.event_title"></sidebar-event>
    </div>
  </div>
</aside>
</template>

<script>
import SidebarEvent from '~Vue/Sidebars/Event';
export default {
  name: 'EventsSidebar',
  props: {
    title: {
      type: String,
      default: 'Links'
    },
    events: {
      type: Array,
      required: true
    }
  },
  components: {
    SidebarEvent
  }
}
</script>

<style lang="scss" scoped>@import '~variables';

#events-sidebar {
    & > .card {
        border: 2px solid $primary-color;
    }
}
</style>
