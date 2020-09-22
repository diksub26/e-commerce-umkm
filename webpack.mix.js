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
mix.js('resources/js/core-public.js', 'public/js')
    .js('resources/js/loader.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/landing.scss', 'public/css/')
    .sass('resources/sass/landing-styles/home.scss', 'public/css/landing')
    .sass('resources/sass/landing-styles/auth.scss', 'public/css/landing')
    .copyDirectory('node_modules/select2/dist', 'public/vendor/select2');

mix.js('resources/js/plugins/dt.js', 'public/js/plugins/dt');
mix.sass('resources/sass/vendor/dt.scss', 'public/css/vendor/dt');