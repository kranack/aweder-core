import cart from './modules/cart';
import modals from './modules/modals';
import activeProduct from './modules/active-product';
import notification from './modules/notification';

export default {
  strict: false,
  modules: {
    cart,
    activeProduct,
    modals,
    notification,
  },
};
