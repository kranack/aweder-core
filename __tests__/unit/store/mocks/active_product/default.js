export default {
  state: {
    activeProduct: {
      product: null,
    },
    cart: {
      order: null,
    },
  },
  actions: {
    'activeProduct/setActiveProduct': jest.fn(),
  },
};
