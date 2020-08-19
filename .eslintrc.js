const path = require('path');

module.exports = {
    root: true,
    env: {
        node: true,
        jest: true,
        browser: true,
    },
    settings: {
      "import/resolver": {
        webpack: {
          config: {
            resolve: {
              alias: {
                '@': path.resolve(__dirname, './resources/'),
              },
              extensions: ['.js', '.jsx', '.ts', '.tsx', '.vue'],
            },
          },
        },
        node: {
          paths: ["resources/js"],
          extensions: [".js", ".jsx", ".ts", ".tsx", ".vue"]
        }
      }
    },
    extends: [
      "airbnb-base",
      "plugin:vue/recommended"
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'import/no-self-import': 'off',
        'no-param-reassign': [2, { 'props': false }],
        'import/no-unresolved': ['error', {
            'ignore': [ '@/' ]
        }],
        // When importing files you do not need to add file extensions for the following extensions
        "import/extensions": ["error", "always", {
          "js": "never",
          "jsx": "never",
          "vue": "never"
        }],
        'no-restricted-syntax': [
            'error',
            {
                selector: 'ForInStatement',
                message: 'for..in loops iterate over the entire prototype chain, which is virtually never what you want. Use Object.{keys,values,entries}, and iterate over the resulting array.',
            },
            {
                selector: 'LabeledStatement',
                message: 'Labels are a form of GOTO; using them makes code confusing and hard to maintain and understand.',
            },
            {
                selector: 'WithStatement',
                message: '`with` is disallowed in strict mode because it makes code impossible to predict and optimize.',
            },
        ],
    },
    parserOptions: {
        parser: 'babel-eslint',
    },
    plugins: ['jest'],
};
