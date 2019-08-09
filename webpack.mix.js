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
mix.copy('node_modules/filepond/dist/filepond.min.css', 'public/css');
mix.copy('node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css', 'public/css');
mix.copy('node_modules/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css', 'public/css');
