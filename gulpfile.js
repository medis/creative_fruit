var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  // Compile CSS.
  mix.sass('app.scss');
  mix.scripts([
    'dropzone.js',
    'masonry.js',
    'carousels.js',
    'sticky.js',
    'form_visibility.js',
    'mobile_menu.js'
  ]);
  mix.version([
    'css/app.css',
    'js/all.js',
  ]);
});
