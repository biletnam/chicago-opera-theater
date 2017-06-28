import Vue from 'vue';
import Hero from '~Vue/Hero';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('masthead')) {
      const node = document.getElementById('masthead');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(Hero, { props }),
      }).$mount('#masthead');
    }
  });
}());
