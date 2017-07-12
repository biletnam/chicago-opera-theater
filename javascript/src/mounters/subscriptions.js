import Vue from 'vue';
import Subscriptions from '~Vue/Subscriptions';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('subscriptions')) {
      const node = document.getElementById('subscriptions');
      const props = JSON.parse(node.getAttribute('data'));

      new Vue({
        render: h => h(Subscriptions, { props }),
      }).$mount('#subscriptions');
    }
  });
}());
