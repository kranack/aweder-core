export default {
  NOTIFY(state, payload) {
    state.type = payload.type;
    state.message = payload.message;
    state.visible = true;

    setTimeout(() => {
      state.visible = false;
    }, 6000);
  },
};
