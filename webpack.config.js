const ExtractTextPlugin = require('extract-text-webpack-plugin');
const { resolve } = require('path');
const webpack = require('webpack');
const OptimizeCSSPlugin = require('optimize-css-assets-webpack-plugin');
const LiveReloadPlugin = require('webpack-livereload-plugin');

module.exports = {
  stats: {
    errorDetails: true,
  },
  entry: './javascript/src/index.js',
  output: {
    filename: 'script.js',
    path: resolve(__dirname, 'javascript'),
  },
  watch: true,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.(scss|sass|css)$/i,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            { loader: 'css-loader', options: { minimize: true } },
            { loader: 'sass-loader', options: { sourceMap: true } },
            { loader: 'postcss-loader', options: {} },
          ],
        }),
      },
      {
        test: /.vue$/,
        loader: 'vue-loader',
        options: {
          extractCSS: true,
          loaders: {
            scss: 'vue-style-loader!css-loader!sass-loader!postcss-loader',
            sass: 'vue-style-loader!css-loader!sass-loader?indentedSyntax!postcss-loader',
          },
          postLoaders: {
            html: 'babel-loader',
          },
        },
      },
    ],
  },
  plugins: [
    new ExtractTextPlugin('../css/main.css'),
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false,
      },
    }),
    new OptimizeCSSPlugin({
      cssProcessorOptions: {
        safe: true,
      },
    }),
    new LiveReloadPlugin({}),
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"',
      },
    }),
  ],
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': resolve(__dirname, 'javascript', 'src'),
      '~Css': resolve(__dirname, 'css'),
      variables: resolve(__dirname, 'css', '_variables.scss'),
      '~Vue': resolve(__dirname, 'javascript/src/components'),
      '~Mounters': resolve(__dirname, 'javascript/src/mounters'),
      '~Scripts': resolve(__dirname, 'javascript/src/scripts'),
    },
  },
};
