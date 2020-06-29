const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const Dotenv = require('dotenv-webpack');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

const buildPath = path.resolve(__dirname, 'public/');

module.exports = {
  mode: 'production',
  watch: true,
  // This option controls if and how source maps are generated.
  // https://webpack.js.org/configuration/devtool/
  devtool: 'source-map',
  // https://webpack.js.org/concepts/entry-points/#multi-page-application
  entry: {
    index: './resources/js/app.js',
  },

  node: {
    fs: 'empty',
  },
  performance: {
    hints: false,
  },
  // how to write the compiled files to disk
  // https://webpack.js.org/concepts/output/
  output: {
    filename: 'main.js',
    path: buildPath,
  },

  // https://webpack.js.org/concepts/loaders/
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
      },
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
        ],
      },

      {
        test: /\.(ttf|eot|woff|woff2|otf)$/,
        loader: 'file-loader',
        options: {
          name: 'fonts/[name].[ext]',
        },
      },
      {
        test: /\.(mp4)$/,
        loader: 'file-loader',
        options: {
          name: 'videos/[name].[ext]',
        },
      },
      {
        test: /\.svg$/,
        loader: 'svg-inline-loader',
      },
      {
        test: /\.(png|jpg|gif|ico)$/,
        loader: 'file-loader',
        options: {
          name: 'images/[name].[hash:20].[ext]',
        },
      },
      {
        test: /\.(jpg|png|gif)$/,
        loader: 'image-webpack-loader',
        // Specify enforce: 'pre' to apply the loader
        // before url-loader/svg-url-loader
        // and not duplicate it in rules with them
        enforce: 'pre',
        options: {
          disable: false, // webpack@2.x and newer
        },
      },
      {
        test: /\.scss$/,
        use: [
          // fallback to style-loader in development
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
        ],
      },
    ],
  },

  // https://webpack.js.org/concepts/plugins/
  plugins: [
    new Dotenv({
      path: path.resolve(__dirname, './.env'),
      safe: false,
      systemvars: true,
      allowEmptyValues: true,
      silent: false,
      defaults: false,
    }),
    new MiniCssExtractPlugin({
      filename: 'style.css',
      chunkFilename: 'style.css',
    }),
    new VueLoaderPlugin(),
  ],
  resolve: {
    extensions: ['.js', '.vue', '.json', '.sass'],
    alias: {
      '@': path.resolve(__dirname, './resources/'),
    },
  },

  // https://webpack.js.org/configuration/optimization/
  optimization: {
    minimizer: [
      new TerserPlugin({
        cache: true,
        parallel: true,
        sourceMap: true,
      }),
      new OptimizeCssAssetsPlugin({}),
    ],
  },
};
