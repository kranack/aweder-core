import 'core-js';
import 'regenerator-runtime/runtime';
import MerchantOrderTypes from '@/js/components/shared/business_details/MerchantOrderTypes';
import UrlSlugChecker from '@/js/components/registration/UrlSlugChecker';
import InventoryItem from '@/js/components/store/InventoryItem';
import Basket from '@/js/components/store/Basket';
import MiniCart from '@/js/components/store/MiniCart';
import ServiceTypePopup from '@/js/components/store/ServiceTypePopup';
import ItemOptionsPopup from '@/js/components/store/ItemOptionsPopup';
import Popup from '@/js/components/shared/Popup';
import OrdersPanel from '@/js/components/admin/orders/OrdersPanel';
import Vue from 'vue';
import Vuex from 'vuex';
import VueMoment from 'vue-moment';
import store from './store';

// Classes
import AdminMenu from './AdminMenu';
import DeliveryCost from './DeliveryCost';
import MerchantRegistration from './MerchantRegistration';
import NotificationBanner from './NotificationBanner';
import OpeningTimes from './OpeningTimes';
import OrderFilters from './OrderFilters';
import SlugChecker from './SlugChecker';
import StripeElements from './StripeElements';
import Upload from './Upload';

// Filters
import './filters/Currency';

// SASS
import '@/sass/app.scss';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Init Vue
Vue.config.devtools = process.env.APP_ENV === 'local';
Vue.config.productionTip = false;
Vue.config.silent = false;
Vue.use(VueMoment);
Vue.use(Vuex);

new Vue({
  components: {
    UrlSlugChecker,
    'merchant-order-types': MerchantOrderTypes,
    InventoryItem,
    MiniCart,
    Basket,
    Popup,
    ServiceTypePopup,
    ItemOptionsPopup,
    OrdersPanel,
  },
  store,
}).$mount('#app');

// Init Classes
const adminMenu = new AdminMenu();
adminMenu.init();

const deliveryCost = new DeliveryCost();
deliveryCost.init();

const merchantRegistration = new MerchantRegistration();
merchantRegistration.init();

const notificationBanner = new NotificationBanner();
notificationBanner.init();

const openingTimes = new OpeningTimes();
openingTimes.init();

const orderFilters = new OrderFilters();
orderFilters.init();

const slugChecker = new SlugChecker();
slugChecker.init();

const stripeElements = new StripeElements();
stripeElements.init();

const upload = new Upload();
upload.init();
