import Vue from 'vue';
import EventsSidebar from '~Vue/EventsSidebar';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('events-sidebar')) {
      const node = document.getElementById('events-sidebar');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(EventsSidebar, { props }),
      }).$mount('#events-sidebar');
    }
  });
}());
