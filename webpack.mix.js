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
    .copy('resources/assets/js/scripts.bundle.js', 'public/js/scripts.bundle.js')
    .copy('resources/assets/js/vendors.bundle.js', 'public/js/vendors.bundle.js')
    .js('resources/assets/js/login.js', 'public/js')
    .copyDirectory('resources/assets/css/fonts', 'public/css/fonts')
    .copyDirectory('resources/assets/img', 'public/assets/img')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles('resources/assets/css/style.bundle.css', 'public/css/style.bundle.css')
    .styles('resources/assets/css/vendors.bundle.css', 'public/css/vendors.bundle.css')
    .version();