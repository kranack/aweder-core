export const subtotal = (state) => {
  let total = 0;

  state.products.forEach((item) => {
    if (item.options) {
      const items = item.options.map((group) => group.items);
      const options = [].concat(...items).map((optionItem) => optionItem);
      total += options.reduce((acc, option) => acc + option.price_modified * item.quantity, 0);
    }

    if (item.variant) {
      total += item.variant.price * item.quantity;
    } else {
      total += item.product.price * item.quantity;
    }
  });

  return total;
};

export const quantity = (state) => state.products.reduce((acc, product) => acc + product.quantity, 0);
