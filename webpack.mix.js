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
mix.copy('node_modules/chosen-js/chosen.jquery.js', 'public/chosen');
mix.copy('node_modules/chosen-js/chosen.css', 'public/chosen');
mix.copy('node_modules/chosen-js/chosen-sprite.png', 'public/chosen');
mix.copy('node_modules/chosen-js/chosen-sprite@2x.png', 'public/chosen');
mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.js', 'public/jquery-slimscroll/jquery.slimscroll.js');
