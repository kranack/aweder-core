export default {
  actions: {
    'cart/addToCart': jest.fn(),
    'cart/setOrder': jest.fn(),
    'activeProduct/removeActiveProduct': jest.fn(),
  },
  state: {
    activeProduct: {
      product: {
        id: 1,
        title: 'Nachos & Cheese',
        price: 500,
        variants: [],
        option_groups: [],
      },
    },
    cart: {
      order: null,
    },
  },
};
