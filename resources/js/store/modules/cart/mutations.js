export default {
  ADD_TO_CART(state, payload) {
    state.products.push({
      id: payload.id,
      product: payload.product,
      quantity: payload.quantity,
      variant: payload.variant,
      options: payload.options,
    });
  },
  REMOVE_FROM_CART(state, payload) {
    state.products = state.products.filter((item) => item.id !== payload);
  },
  UPDATE_PRODUCT(state, payload) {
    const stateProduct = state.products.find((item) => item.id === payload.id);

    stateProduct.quantity = payload.quantity;
  },
  SET_ORDER(state, payload) {
    state.order = payload;
  },
  SET_SERVICE_TYPE(state, payload) {
    state.serviceType = payload;
  },
  SET_DATETIME(state, payload) {
    state.datetime = payload;
  },
};
