const { mix } = require('laravel-mix');

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

/*mix.js('resources/assets/js/app.js', 'public/js');*/
   /*.sass('resources/assets/sass/app.scss', 'public/css');*/
mix.scripts(['resources/assets/js/app.js', 'resources/assets/js/shuffle-sort.js', ], 'public/js/app.js');

mix.scripts('resources/assets/js/admin.js', 'public/js/admin.js');
mix.scripts('resources/assets/js/subscribers.js', 'public/js/subscribers.js');
mix.scripts('resources/assets/js/images.js', 'public/js/images.js');
mix.scripts('resources/assets/js/messages.js', 'public/js/messages.js');

mix.scripts(['resources/assets/js-vendors/jquery-1.8.3.min.js',
			'resources/assets/js-vendors/ajaxSetup.js',
			'resources/assets/js-vendors/jquery.mobile.customized.min.js',
			'resources/assets/js-vendors/bootstrap.min.js',
			'resources/assets/js-vendors/jquery.easing.1.3.js',
			'resources/assets/js-vendors/camera.min.js',
			'resources/assets/js-vendors/jquery.slicknav.js',
			'resources/assets/js-vendors/jquery.prettyPhoto.js',
			'resources/assets/js-vendors/select2.js',
			'resources/assets/js-vendors/shuffle.js'
			], 'public/js/vendors.js');

mix.styles('resources/assets/css/*.css', 'public/css/master.css');

/*mix.styles('node_modules/admin-lte/dist/css/AdminLTE.css', 'public/css/admin/AdminLTE.css');

mix.styles('node_modules/admin-lte/dist/css/skins/skin-blue.css', 'public/css/admin/skins/skin-blue.css');

mix.scripts('node_modules/admin-lte/dist/js/app.js', 'public/js/admin/panel.js');

mix.scripts('node_modules/admin-lte/plugins/jQuery/jquery-2.2.3.min.js', 'public/js/admin/jquery-2.2.3.min.js');

mix.scripts('node_modules/admin-lte/bootstrap/js/bootstrap.js', 'public/js/admin/bootstrap.js');*/




