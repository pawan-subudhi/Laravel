const mix = require('laravel-mix');

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
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
      'resources/external/fonts/icomoon/style.css',
      'resources/external/css/bootstrap.min.css',
      'resources/external/css/magnific-popup.css',
      'resources/external/css/jquery-ui.css',
      'resources/external/css/owl.carousel.min.css',
      'resources/external/css/owl.theme.default.min.css',
      'resources/external/css/bootstrap-datepicker.css',
      'resources/external/css/animate.css',
      'resources/external/css/aos.css',
      'resources/external/css/style.css',
   ], 'public/css/all.css');
