const { styles } = require('laravel-mix');
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

mix.js(['resources/js/app.js', 'public/js/owl.carousel.min.js', 'public/js/main.js'], 'public/js/all.js')
//mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    //mix.styles(['resources/saac/app.scss', 'public/css/owl.carousel.min.css', 'public/css/web.css'], 'public/assets/css/all.css')
    //mix.copy('public/css/web.css','public/css/web.scss')
    .styles(['public/css/app.css', 'public/css/owl.carousel.min.css', 'public/css/web.css'], 'public/css/all.css')
    .sourceMaps();
