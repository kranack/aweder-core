export default {
  $store: {
    state: {
      activeProduct: {
        product: {
          id: 1,
          title: 'Nachos & Cheese',
          price: 500,
          variants: [
            {
              id: 1,
              inventory_id: 1,
              name: 'Variant 1',
              price: 400,
            },
            {
              id: 2,
              inventory_id: 1,
              name: 'Variant 2',
              price: 500,
            },
          ],
          option_groups: [],
        },
      },
      cart: {
        order: null,
      },
    },
    actions: {
      'cart/addToCart': jest.fn(),
      'cart/setOrder': jest.fn(),
      'activeProduct/removeActiveProduct': jest.fn(),
    },
    dispatch: jest.fn(),
  },
};
