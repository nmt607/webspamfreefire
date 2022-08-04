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
mix.copyDirectory('resources/images', 'public/images')
// frontend
mix.js('resources/js/frontend/index.js', 'public/js/frontend/index.js')
    .sass('resources/sass/frontend/main.scss', 'public/css/frontend/main.css')

//backend
mix.js('resources/js/backend/*.js', 'public/js/backend/index.js')
    .sass('resources/sass/backend/main.scss', 'public/css/backend')
