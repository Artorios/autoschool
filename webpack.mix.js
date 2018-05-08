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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/siteApp.js', 'public/js/distrib.js')
    .js('resources/assets/js/account.js', 'public/js/account.js')
    .js('resources/assets/js/autoschool.js', 'public/js/autoschool.js')
    .js('resources/assets/js/investor.js', 'public/js/investor.js')
    .less('resources/assets/less/style.less', 'public/css');

mix.copy('resources/assets/public/selectric.css', 'public/css')
    .copy('resources/assets/public/slick.css', 'public/css')
    .copy('resources/assets/public/slick-theme.css', 'public/css');
