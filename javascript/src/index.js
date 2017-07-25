import Vue from 'vue';
import Buefy from 'buefy';
import '~Css/style.scss';

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

Vue.use(Buefy, {
  defaultIconPack: 'fa',
});
