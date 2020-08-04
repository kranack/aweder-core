export const addToCart = ({ commit }, payload) => {
  commit('ADD_TO_CART', payload);
};

export const removeFromCart = ({ commit }, payload) => {
  commit('REMOVE_FROM_CART', payload);
};

export const incrementProduct = ({ commit }, payload) => {
  commit('INCREMENT_PRODUCT', payload);
};

export const setOrder = ({ commit }, payload) => {
  commit('SET_ORDER', payload);
};

export const setServiceType = ({ commit }, payload) => {
  commit('SET_SERVICE_TYPE', payload);
};

export const setDatetime = ({ commit }, payload) => {
  commit('SET_DATETIME', payload);
};
