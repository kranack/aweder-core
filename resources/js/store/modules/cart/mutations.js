export default {
  ADD_TO_CART(state, payload) {
    state.products.push({
      id: Date.now(),
      product: payload.product,
      quantity: payload.quantity,
      variant: payload.variant,
      options: payload.options,
    });
  },
  REMOVE_FROM_CART(state, payload) {
    const stateProduct = state.products.find((item) => item.id === payload);

    if (stateProduct) {
      stateProduct.quantity -= 1;
    }

    if (stateProduct && stateProduct.quantity < 1) {
      state.products = state.products.filter((item) => item.id !== payload);
    }
  },
  INCREMENT_PRODUCT(state, payload) {
    const stateProduct = state.products.find((item) => item.id === payload);

    stateProduct.quantity += 1;
  },
  SET_ORDER(state, payload) {
    state.order = payload;
  },
};
