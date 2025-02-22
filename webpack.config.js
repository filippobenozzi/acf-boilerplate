require('dotenv').config(); // carica le variabili da .env

const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const LOCAL_DOMAIN = process.env.LOCAL_DOMAIN || 'http://localhost';
const THEME_NAME   = process.env.THEME_NAME || 'nome-tema';
const devMode      = process.env.NODE_ENV !== 'production';

module.exports = {
  mode: devMode ? 'development' : 'production',

  entry: {
    main: [
      `./wp-content/themes/${THEME_NAME}/assets/src/js/main.js`,
      `./wp-content/themes/${THEME_NAME}/assets/src/sass/style.scss`,
    ],
  },

  output: {
    path: path.resolve(__dirname, `wp-content/themes/${THEME_NAME}/assets/dist`),
    filename: 'js/[name].bundle.js',
    clean: true,
  },

  devtool: devMode ? 'source-map' : false,

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'],
          },
        },
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  require('autoprefixer'),
                  // in production anche [require('cssnano')]
                ],
              },
            },
          },
          {
            loader: 'sass-loader',
            options: {
              // Aggiungi questo oggetto se vuoi nascondere i warning
              sassOptions: {
                quietDeps: true
              }
            }
          }
        ]
      }      
    ],
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
    new webpack.DefinePlugin({
      'process.env.LOCAL_DOMAIN': JSON.stringify(LOCAL_DOMAIN),
      'process.env.THEME_NAME': JSON.stringify(THEME_NAME),
    }),
  ],

  devServer: {
    proxy: [
      {
        context: () => true,
        target: LOCAL_DOMAIN,
        changeOrigin: true,
        secure: false,
      }
    ],
  },
};