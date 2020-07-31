export const productsWithoutVariant = () => ({
  products: [
    {
      id: '1596187347277',
      quantity: 1,
      variant: null,
      product: {
        id: 1,
        price: 500,
        title: 'Nachos,Cheese & Chilli',
      },
      options: {
        'Option Group': [
          {
            name: 'Option 1',
            price_modified: 499,
          },
        ],
      },
    },
  ],
});

export const productsWithVariant = () => ({
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
      options: {
        'Option Group': [
          {
            name: 'Option 1',
            price_modified: 499,
          },
        ],
      },
    },
  ],
});
