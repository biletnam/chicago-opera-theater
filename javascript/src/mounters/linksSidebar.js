import Vue from 'vue';
import LinksSidebar from '~Vue/LinksSidebar';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('links-sidebar')) {
      const node = document.getElementById('links-sidebar');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(LinksSidebar, { props }),
      }).$mount('#links-sidebar');
    }
  });
}());
