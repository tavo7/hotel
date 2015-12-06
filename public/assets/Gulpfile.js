// Get modules
var gulp = require('gulp');
var stylus = require('gulp-stylus');
var nib = require('nib');
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var inject = require('gulp-inject');
var wiredep = require('wiredep').stream;
var minifyCSS = require("gulp-minify-css");
var livereload = require("gulp-livereload");
var uglify = require("gulp-uglify");
var rename = require("gulp-rename");
// Task boilerplate
gulp.task('css', function() {
	gulp.src('stylus/main.styl')
		.pipe(stylus({ use: nib() }))
		.pipe(minifyCSS())
		.pipe(gulp.dest('../css'))
		.pipe(livereload());
});


gulp.task('scripts', function() {
    gulp.src('jsdev/main.js')
        .pipe(uglify())
        .pipe(rename('main.min.js'))
        .pipe(gulp.dest('../js'))
        .pipe(livereload());
});

gulp.task('jshint', function() {
	return gulp.src('jsdev/**.js')
			.pipe(jshint('.jshintrc'))
			.pipe(jshint.reporter('jshint-stylish'))
			.pipe(jshint.reporter('fail'));
});

gulp.task('wiredep', function () {
	gulp.src('../../app/views/layouts/master.blade.php')
		.pipe(wiredep({
			directory: '../vendor',
			ignorePath: '../../../public'
		}))
		.pipe(gulp.dest('../../app/views/layouts/'));
});

gulp.task('inject', function() {
var sources = gulp.src(['../js/app/**/*.js', '../css/**/*.css']);
			return gulp.src('master.blade.php' ,{cwd: '../../app/views/layouts/'})
						.pipe(inject(sources,{
								read: false,
								ignorePath: '../'
								})
						)
						.pipe(gulp.dest('../js/app/'));
});

gulp.task('watch', function () {
    var server = livereload();
    gulp.watch(['stylus/**/*.styl'], ['css','inject']);
    gulp.watch('jsdev/**.js', ['scripts','jshint','inject']);
    gulp.watch('../js/app/**/*.js', ['inject']);
    gulp.watch(['./bower.json'], ['wiredep']);
    gulp.watch('../../app/views/**/*.php').on('change', function(file) {
    server.changed(file.path);
	})
});
// The default task (called when you run `gulp` from cli)
gulp.task('default', ['scripts','watch','inject','wiredep']);