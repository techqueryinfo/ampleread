const { mix } = require('laravel-mix');

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

mix.js([
	'resources/assets/js/bootstrap.min.js',
	'resources/assets/js/jquery.min.js',
	'resources/assets/js/owl.carousel.js',
	'resources/assets/js/main.js'
	], 'public/js/all.js')
   // .js('resources/assets/js/app.js', 'public/js')
   // .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/main.css',
    'resources/assets/css/owl.carousel.css',
    'resources/assets/css/owl.theme.default.css'
	], 'public/css/all.css');
   .version();