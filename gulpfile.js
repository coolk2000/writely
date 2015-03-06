var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', 'public/compiled/css');

    mix.styles([
        'libs/bootstrap.min.css',
        'libs/animate.min.css'
    ], 'public/compiled/css/min.css');

    mix.scripts([
        'libs/jquery.min.js',
        'libs/bootstrap.min.js'
    ], 'public/compiled/js/min.js');
});
