export default {
  $store: {
    state: {
      notification: {
        visible: true,
        type: 'error',
        message: 'Notification message',
      },
    },
    dispatch: jest.fn(),
  },
};
