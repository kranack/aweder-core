export default {
  $store: {
    state: {
      notification: {
        visible: false,
        type: 'success',
        message: 'Notification message',
      },
    },
    dispatch: jest.fn(),
  },
};
