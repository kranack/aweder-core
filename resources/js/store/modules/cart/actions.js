export const addToCart = ({ commit }, product) => {
  commit('ADD_TO_CART', product);
};

export const removeFromCart = ({ commit }, product) => {
  commit('REMOVE_FROM_CART', product);
};
