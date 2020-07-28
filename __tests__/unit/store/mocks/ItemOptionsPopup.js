export const mockInactiveStore = {
  state: {
    activeProduct: {
      product: null,
    },
  },
};

export const mockActiveStore = {
  actions: {
    'cart/addToCart': jest.fn(),
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
  },
};
