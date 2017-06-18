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
mix.webpackConfig({
    resolve: {
        alias: {
            jquery: 'jquery/src/jquery'
        }
    }
});

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['vue', 'jquery', 'bootstrap-sass', 'axios', 'chart.js', 'vue-chartjs']);

mix.styles([
    'resources/assets/css/custom.css',
    'resources/assets/css/app.css',
    'resources/assets/css/chosen.css',
    'resources/assets/css/sweetalert.css'
], 'public/css/all.css');

if (mix.config.inProduction) {
    mix.version();
}