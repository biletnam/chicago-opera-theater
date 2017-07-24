<template>
<aside id="show-sidebar" class="column is-4">
  <div class="card">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon icon="calendar"></b-icon>&nbsp;
        Performances
      </h4>
    </header>
    <div class="card-content">
      <div>
        <ul>
          <li v-for="date in details.performances">
            <a :href="date.ticket_link">
              {{date.date}}
            </a>
          </li>
        </ul>
      </div>
    </div>
    <footer class="card-footer" v-if="details.ticket_link">
      <div class="card-footer-item">
        <sidebar-link :link="{title: 'Buy Tickets', url: details.ticket_link}"></sidebar-link>
      </div>
    </footer>
  </div>
  <div class="card has-margin-top-sm">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon icon="map-marker"></b-icon>&nbsp;
        Venue
      </h4>
    </header>
    <div class="card-content">
      <div v-html="details.venue"></div>
    </div>
    <footer class="card-footer" v-if="details.map_link">
      <div class="card-footer-item">
        <sidebar-link :link="{title: 'Get Directions', url: details.map_link}"></sidebar-link>
      </div>
    </footer>
  </div>
  <div class="card has-margin-top-sm">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon

            icon="clock-o">
        </b-icon>&nbsp;
        Duration &amp; Language
      </h4>
    </header>
    <div class="card-content">
      <div v-html="details.duration_and_language"></div>
    </div>
  </div>
  <div class="has-margin-top-lg">
    <a href="https://chicagooperatheater.secure.force.com/signup" target="_blank" class="button is-medium is-primary" style="display: block;">
          Join Our Mailing List
        </a>
  </div>
</aside>

</template>

<script>
import SidebarEvent from '~Vue/Sidebars/Event';
import SidebarLink from '~Vue/Sidebars/Link';
export default {
  name: 'ShowSidebar',
  props: {
    details: {
      type: Object,
      required: true
    }
  },
  components: {
    SidebarEvent,
    SidebarLink
  }
}

</script>
