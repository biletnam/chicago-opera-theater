import Vue from 'vue';
import HeaderCarousel from '~Vue/HeaderCarousel';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('header-carousel')) {
      const node = document.getElementById('header-carousel');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(HeaderCarousel, { props }),
      }).$mount('#header-carousel');
    }
  });
}());
