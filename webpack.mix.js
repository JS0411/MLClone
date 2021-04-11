const mix = require('laravel-mix');

const path = require('path');

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@vue-instantsearch': path.resolve(__dirname, 'node_modules/vue-instantsearch/src/'),
      '@node': path.resolve(__dirname, 'node_modules/'),
    },
  },
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');
