import Vue from 'vue';
import 'core-js';
import 'regenerator-runtime/runtime';
import UrlSlugChecker from '@/js/components/registration/UrlSlugChecker';
import MerchantOrderTypes
  from '@/js/components/shared/business_details/MerchantOrderTypes';
import NotificationBanner from './notification';
import SlugChecker from './slug-checker';
import Upload from './upload';
import MerchantRegistration from './merchant_registration';
import Delivery from './delivery_cost';
import StripeElements from './stripe-elements';
import OrderFilters from './order_filters';
import AdminMenu from './admin-menu';
import OpeningTimes from './opening-times';

import '@/sass/app.scss';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const banner = new NotificationBanner();
banner.init();

const slugChecker = new SlugChecker();
slugChecker.init();

const stripe = new StripeElements();
if (document.getElementById('card-element')) {
  stripe.init();
}

const merchantRegistration = new MerchantRegistration();
merchantRegistration.init();

const collectionChoice = new Delivery();
collectionChoice.init();

const upload = new Upload();
upload.init();

const orderFilters = new OrderFilters();
orderFilters.init();

const adminMenu = new AdminMenu();
adminMenu.init();

const openingTimes = new OpeningTimes();
openingTimes.init();

Vue.config.devtools = process.env.APP_ENV === 'local';
Vue.config.productionTip = false;
Vue.config.silent = false;

new Vue({
  components: {
    UrlSlugChecker,
    'merchant-order-types': MerchantOrderTypes,
  },
}).$mount('#app');
