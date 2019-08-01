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

// main application resources
mix.js('resources/js/app.js', 'public/js');

// chosen js resources
mix.copy('node_modules/slick-carousel/slick/slick.min.js', 'public/slick');
mix.copy('node_modules/slick-carousel/slick/slick.css', 'public/slick');
mix.copy('node_modules/slick-carousel/slick/slick-theme.css', 'public/slick');
mix.copy('node_modules/cropme/dist/cropme.css', 'public/css');
mix.copy('node_modules/cropme/dist/cropme.js', 'public/js');
