import Vue from 'vue';
import Buefy from 'buefy';
// import VeeValidate from 'vee-validate';
import '~Css/style.scss';

require('es6-promise').polyfill();
require('~Mounters/navigation');
require('~Mounters/hero');
require('~Mounters/headerCarousel');
require('~Mounters/footing');
require('~Mounters/linksSidebar');
require('~Mounters/eventsSidebar');
require('~Mounters/showSidebar');
require('~Mounters/showContent');
require('~Mounters/gmaps');
require('~Mounters/subscriptions');
require('~Mounters/gallery');

/* const config = {
  classNames: {
    valid: 'is-success', // model is valid
    invalid: 'is-error', // model is invalid
  },
  enableAutoClasses: false,
};

Vue.use(VeeValidate, config);*/

Vue.use(Buefy, {
  defaultIconPack: 'fa',
});
