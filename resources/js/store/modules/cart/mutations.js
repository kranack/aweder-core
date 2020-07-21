export default {
  ADD_TO_CART(state, payload) {
    const stateProduct = state.products.find((product) => product.id === payload.id);

    if (stateProduct) {
      stateProduct.quantity += 1;
    } else {
      state.products.push({
        id: payload.id,
        price: payload.price,
        quantity: 1,
      });
    }
  },
  REMOVE_FROM_CART(state, payload) {
    const stateProduct = state.products.find((product) => product.id === payload.id);

    if (stateProduct) {
      stateProduct.quantity -= 1;
    }

    if (stateProduct && stateProduct.quantity < 1) {
      state.products = state.products.filter((product) => product.id !== payload.id);
    }
  },
};
