export const subtotal = (state) => {
  // let total = 0;

  // state.products.forEach((item) => {
  //   if (item.options) {
  //     total += item.options.reduce((acc, option) => acc + option.quantity * product.product.price, 0);
  //   }
  // });
  return state.products.reduce((acc, product) => acc + product.quantity * product.product.price, 0);
};

export const quantity = (state) => state.products.reduce((acc, product) => acc + product.quantity, 0);
