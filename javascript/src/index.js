import Vue from 'vue';
import Buefy from 'buefy';
import '~Css/style.scss';

require('~Mounters/navigation');
require('~Mounters/hero');
require('~Mounters/footing');
require('~Mounters/linksSidebar');

Vue.use(Buefy);
