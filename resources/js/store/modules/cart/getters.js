export const total = (state) => state.products.reduce((acc, product) => acc + product.quantity * product.price, 0);

export const quantity = (state) => state.products.reduce((acc, product) => acc + product.quantity, 0);
