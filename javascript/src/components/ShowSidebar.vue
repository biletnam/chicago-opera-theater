<template>
<aside id="show-sidebar" class="column is-4">
  <div class="card">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon
            pack="fa"
            icon="calendar">
        </b-icon>&nbsp;
        Performances
      </h4>
    </header>
    <div class="card-content">
      <div>
        <ul>
          <li v-for="date in details.performances">
            <p>
              {{date.date}}
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card has-margin-top-sm">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon
            pack="fa"
            icon="map-marker">
        </b-icon>&nbsp;
        Venue
      </h4>
    </header>
    <div class="card-content">
      <div v-html="details.venue"></div>
    </div>
  </div>
  <div class="card has-margin-top-sm">
    <header class="card-header">
      <h4 class="card-header-title">
        <b-icon
            pack="fa"
            icon="clock-o">
        </b-icon>&nbsp;
        Duration &amp; Language
      </h4>
    </header>
    <div class="card-content">
      <div v-html="details.duration_and_language"></div>
    </div>
  </div>
</aside>
</template>

<script>
import SidebarEvent from '~Vue/Sidebars/Event';
export default {
  name: 'ShowSidebar',
  props: {
    details: {
      type: Object,
      required: true
    }
  },
  components: {
    SidebarEvent
  }
}
</script>
