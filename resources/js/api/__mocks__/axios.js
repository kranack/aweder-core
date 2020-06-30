export default {
  defaults: {
    headers: {
      common: {},
    },
  },
  interceptors: {
    request: {
      use: jest.fn(),
    },
  },
  get: jest.fn(() => Promise.resolve({
    status: 200,
    data: {
      data: {},
      meta: {},
    },
  })),

  post: jest.fn(() => Promise.resolve({
    status: 200,
    data: {
      data: {},
      meta: {},
    },
  })),
  patch: jest.fn(() => Promise.resolve({
    status: 204,
    data: {
      data: {},
      meta: {},
    },
  })),
};
