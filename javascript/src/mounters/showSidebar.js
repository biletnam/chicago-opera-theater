import Vue from 'vue';
import ShowSidebar from '~Vue/ShowSidebar';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('show-sidebar')) {
      const node = document.getElementById('show-sidebar');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(ShowSidebar, { props }),
      }).$mount('#show-sidebar');
    }
  });
}());
