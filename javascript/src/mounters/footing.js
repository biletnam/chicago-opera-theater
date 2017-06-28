import Vue from 'vue';
import Footing from '~Vue/Footing';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('footer')) {
      const node = document.getElementById('footer');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(Footing, { props }),
      }).$mount('#footer');
    }
  });
}());
