const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const isProd = process.env.NODE_ENV === 'production';
const buildPath = path.resolve(__dirname, 'public/build');

module.exports = {
  lintOnSave: 'default',
  productionSourceMap: false,
  pages: {
    index: './resources/js/app.js',
  },
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
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './resources/'),
      },
    },
    performance: {
      hints: false,
    },
  },
  // how to write the compiled files to disk
  // https://webpack.js.org/concepts/output/
  outputDir: buildPath,
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
