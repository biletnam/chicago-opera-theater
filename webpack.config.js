const ExtractTextPlugin = require('extract-text-webpack-plugin')
const { join, resolve } = require('path')

module.exports = {
  entry: './javascript/src/index.js',
  output: {
    filename: 'script.js',
    path: resolve(__dirname, 'javascript')
  },
  watch: true,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['env']
          }
        }
      },
      {
        test: /\.(scss|sass|css)$/i,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            { loader: 'css-loader', options: { minimize: true } },
            { loader: 'sass-loader', options: { sourceMap: true } },
          ],
        }),
      }
    ],
  },
  plugins: [
    new ExtractTextPlugin('../style.css')
  ],
  resolve: {
    alias: {
      '@': resolve(__dirname, 'javascript', 'src'),
      '~Css': resolve(__dirname, 'css'),
    },
  },
};
