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

mix.copy('resources/assets/public/selectric.css', 'public/css')
    .copy('resources/assets/public/slick.css', 'public/css')
    .copy('resources/assets/public/slick-theme.css', 'public/css')
    .copy('resources/assets/public/AdminLTE.min.css', 'public/css')
    .copy('resources/assets/public/skins/_all-skins.min.css', 'public/css/skins');

mix.less('resources/assets/less/main.less', 'public/css/')
  .less('resources/assets/less/selectriks.less', 'public/css/')
  .less('resources/assets/less/main-content.less', 'public/css/')
  .less('resources/assets/less/header.less', 'public/css/')
  .less('resources/assets/less/footer.less', 'public/css/')
  .less('resources/assets/less/registration.less', 'public/css/')
  .less('resources/assets/less/login.less', 'public/css/')
  .less('resources/assets/less/modals.less', 'public/css/')
  .less('resources/assets/less/student-main.less', 'public/css/')
  .less('resources/assets/less/analysis-errors.less', 'public/css/')
  .less('resources/assets/less/statistics.less', 'public/css/')
  .less('resources/assets/less/demo-lesson.less', 'public/css/')
  .less('resources/assets/less/lessons.less', 'public/css/')
  .less('resources/assets/less/training.less', 'public/css/')
  .less('resources/assets/less/tickets.less', 'public/css/')
  .less('resources/assets/less/profile.less', 'public/css/')
  .less('resources/assets/less/exams.less', 'public/css/')
  .less('resources/assets/less/notifications.less', 'public/css/')
  .less('resources/assets/less/finance.less', 'public/css/')
  .less('resources/assets/less/questions-answers.less', 'public/css/')
  .less('resources/assets/less/main-driving-school.less', 'public/css/')
  .less('resources/assets/less/driving-school-coupons.less', 'public/css/')
  .less('resources/assets/less/generation-coupons.less', 'public/css/')
  .less('resources/assets/less/driving-school-personal.less', 'public/css/')
  .less('resources/assets/less/media.less', 'public/css/')
  .combine([
    'public/css/main.css',
    'public/css/selectriks.css',
    'public/css/main-content.css',
    'public/css/header.css',
    'public/css/footer.css',
    'public/css/registration.css',
    'public/css/login.css',
    'public/css/modals.css',
    'public/css/student-main.css',
    'public/css/analysis-errors.css',
    'public/css/statistics.css',
    'public/css/demo-lesson.css',
    'public/css/lessons.css',
    'public/css/training.css',
    'public/css/tickets.css',
    'public/css/profile.css',
    'public/css/exams.css',
    'public/css/notifications.css',
    'public/css/finance.css',
    'public/css/questions-answers.css',
    'public/css/main-driving-school.css',
    'public/css/driving-school-coupons.css',
    'public/css/generation-coupons.css',
    'public/css/driving-school-personal.css'
  ],
    'public/css/style.css');