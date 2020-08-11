export default {
  $store: {
    state: {
      notification: {
        visible: true,
        type: 'success',
        message: 'Notification message',
      },
    },
    dispatch: jest.fn(),
  },
};
