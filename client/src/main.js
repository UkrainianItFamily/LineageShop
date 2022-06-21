import Vue from 'vue';
import { Vuelidate } from 'vuelidate';
import App from './App.vue';
import Constants from './plugins/constsPlugin';
import Functions from './plugins/functionPlugin';
import router from './router';
import store from './store';
import { BootstrapVue } from 'bootstrap-vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import CategoryPropertyComponent from '@/components/form/modal/CategoryPropertyComponent';
import {
  faVk,
  faFacebookSquare,
  faDiscord,
  faGoogle,
  faYandex
} from '@fortawesome/free-brands-svg-icons';
import {
  faStar as faStarRegular,
  faClone
} from '@fortawesome/free-regular-svg-icons';
import {
  faExclamationTriangle,
  faInfoCircle,
  faPaperclip,
  faArrowRight,
  faSearch,
  faChevronLeft,
  faChevronRight,
  faStar as faStarSolid,
  faCaretUp,
  faCaretDown,
  faSort,
  faBell,
  faQuestionCircle,
  faCreditCard,
  faPen,
  faAt,
  faExclamationCircle,
  faExchangeAlt
} from '@fortawesome/free-solid-svg-icons';

const moment = require('moment');
require('moment/locale/ru');
Vue.use(require('vue-moment'), {
  moment
});

Vue.use(Vuelidate);
Vue.use(BootstrapVue);
Vue.use(Constants);
Vue.use(Functions);

library.add(
  faVk,
  faExclamationTriangle,
  faBell,
  faInfoCircle,
  faPaperclip,
  faArrowRight,
  faSearch,
  faStarRegular,
  faStarSolid,
  faChevronLeft,
  faClone,
  faCaretUp,
  faCaretDown,
  faSort,
  faQuestionCircle,
  faCreditCard,
  faPen,
  faChevronRight,
  faAt,
  faExclamationCircle,
  faExchangeAlt,
  faFacebookSquare,
  faDiscord,
  faGoogle,
  faYandex
);
Vue.component('FontAwesomeIcon', FontAwesomeIcon);
Vue.component('CategoryPropertyComponent', CategoryPropertyComponent);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
