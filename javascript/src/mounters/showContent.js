import Vue from 'vue';
import ShowContent from '~Vue/ShowContent';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('show-content')) {
      const node = document.getElementById('show-content');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(ShowContent, { props }),
      }).$mount('#show-content');
    }
  });
}());
