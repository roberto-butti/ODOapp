var elixir = require('laravel-elixir'),
	vendorPath = "bower_components",
	gulp = require("gulp"),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	jsPlugin = [
		vendorPath + "/microm/dist/microm.min.js",
		vendorPath + "/angular/angular.min.js"
	];

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
    mix.sass('app.scss');
});

gulp.task("plugin", function(){
	return gulp.src(jsPlugin)
	.pipe(concat('plugin.js'))
	.pipe(uglify({
		preserveComments: "some"
	}))
	.pipe(gulp.dest("public/vendor/js"));
});