import Vue from 'vue';
import Navigation from '~Vue/Navigation';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('navigation')) {
      const node = document.getElementById('navigation');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(Navigation, { props }),
      }).$mount('#navigation');
    }
  });
}());
