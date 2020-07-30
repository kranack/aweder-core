export const addToCart = ({ commit }, payload) => {
  commit('ADD_TO_CART', payload);
};

export const removeFromCart = ({ commit }, payload) => {
  commit('REMOVE_FROM_CART', payload);
};

export const incrementProduct = ({ commit }, payload) => {
  commit('INCREMENT_PRODUCT', payload);
};
