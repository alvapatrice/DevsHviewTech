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

    mix.sass('app.scss');
    mix.sass(['admin.scss'] , 'public/dashboard/css/custom.css');
	mix.scriptsIn("resources/assets/ts/build", 'public/js/app.js');
	mix.scripts(
			[
			    'app.js',
                'bower_components/lighter/javascripts/jquery.lighter.js',
           ],
			    'public/js/app.min.js',
			    'public/js'
			);
});
