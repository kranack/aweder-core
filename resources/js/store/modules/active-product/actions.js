export const setActiveProduct = ({ commit }, product) => {
  commit('SET_ACTIVE_PRODUCT', product);
};

export const removeActiveProduct = ({ commit }) => {
  commit('REMOVE_ACTIVE_PRODUCT');
};
