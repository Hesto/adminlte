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

var bower_path = "./vendor/bower_components/";

var paths = {
    'public'   : 'public/',
    'jquery'        : bower_path + "jquery/dist/",
    'bootstrap'     : bower_path + "bootstrap-sass/assets/",
    'fontawesome'   : bower_path + "font-awesome/",
    'ionicons'      : bower_path + "Ionicons/",
    'adminlte'      : bower_path + "AdminLTE/",
    'moment'        : bower_path + "moment/",
    'jqueryui'      : bower_path + "jquery-ui/",
    'datatables'      : bower_path + "datatables.net/",
    'datatables_bs'   : bower_path + "datatables.net-bs/"

};

elixir(function(mix) {
    mix
        .copy(paths.fontawesome + '/fonts/', paths.public + 'fonts')
        .copy(paths.ionicons + '/fonts/', paths.public + 'fonts')
        .copy(paths.adminlte + '/dist/img/', paths.public + 'img/adminlte')
        .copy(paths.bootstrap + '/fonts/bootstrap/', paths.public + 'fonts')

        .sass('app.scss', 'resources/assets/css/vendor', {
            includePaths: [
                paths.bootstrap + 'stylesheets',
                paths.fontawesome + 'scss',
                paths.ionicons + 'scss'
            ]
        })

        .styles([
            'vendor/app.css',
            paths.adminlte + 'plugins/daterangepicker/daterangepicker.css',
            paths.adminlte + 'plugins/timepicker/bootstrap-timepicker.min.css',
            paths.adminlte + 'plugins/select2/select2.min.css',
            paths.datatables_bs + 'css/dataTables.bootstrap.css',
            paths.adminlte + 'dist/css/AdminLTE.min.css',
            paths.adminlte + 'dist/css/skins/skin-blue.min.css'
        ], paths.public + 'css')

        .scripts([
            paths.jquery + 'jquery.min.js',
            paths.bootstrap + 'javascripts/bootstrap.min.js',
            paths.jqueryui + 'jquery-ui.min.js',
            paths.datatables + 'js/jquery.dataTables.min.js',
            paths.datatables_bs + 'js/dataTables.bootstrap.min.js',
            paths.adminlte + 'plugins/daterangepicker/daterangepicker.js',
            paths.adminlte + 'plugins/timepicker/bootstrap-timepicker.min.js',
            paths.adminlte + 'plugins/select2/select2.full.min.js',
            paths.adminlte + 'plugins/slimScroll/jquery.slimscroll.min.js',
            paths.adminlte + 'plugins/fastclick/fastclick.js',
            paths.adminlte + 'dist/js/app.min.js',
            paths.moment + 'min/moment.min.js'
        ], paths.public + 'js');
});
