export default {
  $store: {
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
    dispatch: jest.fn(),
  },
};
