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

mix.js('resources/js/app.js', 'public/manager/vendor/js/init.js')
    .sass('resources/sass/app.scss', 'public/manager/vendor/css/init.css')
    .combine([
    	'public/manager/vendor/js/init.js',
      	'public/manager/js/custom-script.js',
	], 'public/manager/vendor/js/main.js')
  .combine([
		'public/manager/vendor/css/init.css',
		'public/manager/css/custom-style.css',
		'public/manager/menu/nestable/nestable.css',
	], 'public/manager/vendor/css/main.css');
