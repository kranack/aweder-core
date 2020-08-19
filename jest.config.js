module.exports = {
  moduleFileExtensions: [
    'js',
    'jsx',
    'json',
    'vue',
  ],
  transform: {
    '^.+\\.vue$': 'vue-jest',
    '.+\\.(css|styl|less|sass|scss|png|jpg|svg|ttf|woff|woff2)$': 'jest-transform-stub',
    '^.+\\.jsx?$': 'babel-jest',
  },
  moduleNameMapper: {
    '^@/(.*)$': '<rootDir>/resources/$1',
  },
  snapshotSerializers: [
    'jest-serializer-vue',
  ],
  testMatch: [
    '<rootDir>/(tests/unit/**/*.spec.(js|jsx|ts|tsx)|__tests__/**/*.(js|jsx|ts|tsx))',
  ],
  modulePathIgnorePatterns: ['mocks'],
  testURL: 'http://localhost/',
  collectCoverage: false,
  collectCoverageFrom: [
    '<rootDir>/resources/js/**/*.{js,vue}',
  ],
  coveragePathIgnorePatterns: [
    '/node_modules/',
    '/dist',
    'testconfig.js',
    'package.json',
    'package-lock.json',
  ],
  transformIgnorePatterns: [
    '/node_modules/',
  ],
};
