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
          option_groups: [
            {
              id: 1,
              name: 'Extras',
              title: 'Modify your order',
              items: [
                {
                  id: 1,
                  name: 'Option 1',
                  price_modified: 150,
                },
                {
                  id: 2,
                  name: 'Option 2',
                  price_modified: 250,
                },
              ],
            },
          ],
        },
      },
      cart: {
        order: null,
        products: [
          { id: 111 },
          { id: 222 },
        ],
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
