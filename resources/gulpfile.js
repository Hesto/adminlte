const elixir = require('laravel-elixir');

//require('laravel-elixir-vue');
require('laravel-elixir-vueify');

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

var node_path = "./node_modules/";

var paths = {
    'public'            : 'public/',
    'bootstrap'         : node_path + "bootstrap-sass/assets/",
    'datarangepicker'   : node_path + "bootstrap-daterangepicker/",
    'timepicker'        : node_path + "bootstrap-timepicker/",
    'colorpicker'       : node_path + "bootstrap-colorpicker/",
    'fontawesome'       : node_path + "font-awesome/",
    'ionicons'          : node_path + "ionicons/",
    'adminlte'          : node_path + "admin-lte/",
    'datatables_bs'     : node_path + "datatables.net-bs/"

};

elixir(mix => {
    mix
    .sass('admin.scss', 'resources/dist/css')
    .sass('front.scss', 'resources/dist/css')
    .sass('app.scss')

    .browserify('admin.js', 'resources/dist/js')
    .browserify('front.js', 'resources/dist/js')
    .browserify('app.js')

    .copy(paths.fontawesome + 'fonts/', paths.public + 'fonts')
    .copy(paths.ionicons + 'fonts/', paths.public + 'fonts')
    .copy(paths.bootstrap + 'fonts/', paths.public + 'fonts')
    .copy(paths.adminlte + 'dist/img/', paths.public + 'img/adminlte')

    .styles([
        './resources/dist/css/admin.css',
        paths.timepicker + 'css/bootstrap-timepicker.min.css',
        paths.colorpicker + 'dist/css/bootstrap-colorpicker.min.css',
        paths.datatables_bs + 'css/dataTables.bootstrap.css',
        paths.adminlte + 'dist/css/AdminLTE.min.css',
        paths.adminlte + 'dist/css/skins/skin-blue.min.css'
    ], paths.public + 'css/admin.css')

    .styles([
        './resources/dist/css/front.css',
    ], paths.public + 'css/front.css')

    .scripts([
        './resources/dist/js/admin.js',
        paths.adminlte + 'dist/js/app.min.js'
    ], paths.public + 'js/admin.js')

    .scripts([
        './resources/dist/js/front.js',
    ], paths.public + 'js/front.js');
});