export default {
  $store: {
    state: {
      cart: {
        products: [
          {
            id: '1596187347277',
            quantity: 1,
            variant: {
              name: 'Variant',
              price: 1100,
            },
            product: {
              id: 1,
              price: 500,
              title: 'Nachos,Cheese & Chilli',
            },
            options: [
              {
                group: 'Option Group',
                items: [
                  {
                    name: 'Option 1',
                    price_modified: 499,
                  },
                ],
              },
            ],
          },
        ],
        orderType: 'delivery',
        order: null,
        datetime: '2020-01-01 00:00:00',
      },
    },
    getters: {
      'cart/subtotal': 500,
      'cart/quantity': 1,
    },
    actions: {
      'cart/removeFromCart': jest.fn(() => Promise.resolve()),
      'cart/incrementProduct': jest.fn(() => Promise.resolve()),
    },
    dispatch: jest.fn(),
  },
};
