let mix = require('laravel-mix');

mix
    .js('assets/src/js/expanding-archives.js', 'assets/build/js')
    .sass('assets/src/sass/expanding-archives.scss', 'assets/build/css');
