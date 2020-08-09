export default {
  $store: {
    state: {
      cart: {
        products: [],
        serviceType: null,
        order: null,
        datetime: null,
      },
    },
    getters: {
      'cart/subtotal': 0,
      'cart/quantity': 0,
    },
    actions: {
      'cart/removeFromCart': jest.fn(() => Promise.resolve()),
      'cart/incrementProduct': jest.fn(() => Promise.resolve()),
    },
    dispatch: jest.fn(),
  },
};
