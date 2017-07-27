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
    },
    button_links: Object
  },
  components: {
    SidebarEvent
  }
}
</script>
