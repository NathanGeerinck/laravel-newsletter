let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js');

mix.styles([
    'resources/assets/css/custom.css',
    'resources/assets/css/app.css',
    'resources/assets/css/chosen.css',
    'resources/assets/css/sweetalert.css'
], 'public/css/app.css');

if (mix.config.inProduction) {
    mix.version();
}