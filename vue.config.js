const TerserPlugin = require('terser-webpack-plugin');
const isProd = process.env.NODE_ENV === 'production';

module.exports = {
  lintOnSave: 'default',
  configureWebpack: {
    optimization: {
      minimize: true,
      minimizer: isProd ? [
        new TerserPlugin({
          terserOptions: {
            ecma: 6,
            compress: { drop_console: true },
            output: { comments: false, beautify: false },
          },
        }),
      ] : [],
    },
  },
  css: {
    loaderOptions: {
      // pass options to sass-loader
      sass: {
        // @/ is an alias to src
        data: `
          @import "@/sass/app.scss";
        `,
      },
    },
  },
};
