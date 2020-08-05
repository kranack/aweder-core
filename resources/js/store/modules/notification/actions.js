export const success = ({ commit }, message) => {
  commit('NOTIFY', {
    message,
    type: 'success',
  });
};

export const error = ({ commit }, message) => {
  commit('NOTIFY', {
    message,
    type: 'error',
  });
};
