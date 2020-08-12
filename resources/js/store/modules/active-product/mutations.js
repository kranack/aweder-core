export default {
  SET_ACTIVE_PRODUCT(state, payload) {
    state.product = payload;
  },
  REMOVE_ACTIVE_PRODUCT(state) {
    state.product = null;
  },
};
