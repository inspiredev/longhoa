var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var prefix = require('gulp-autoprefixer');
var csso = require('gulp-csso');
var rsync = require('gulp-rsync');
var server = require('./server.json');

var path = {
	scss: {
		src: './scss/',
		dest: './css'
	}
};

gulp.task('css', function () {
	return gulp.src(path.scss.src + '**/*.scss')
		.pipe(plumber({
			errorHandler: function (err) {
				gutil.log(gutil.colors.red('Styles error:\n' + err.message));
				// emit `end` event so the stream can resume https://github.com/dlmanning/gulp-sass/issues/101
				if (this.emit) {
					this.emit('end');
				}
			}
		}))
		.pipe(sass())
		.pipe(prefix())
		.pipe(csso())
		.pipe(gulp.dest(path.scss.dest));
});

gulp.task('deploy', function () {
	return gulp.src(['./**', '!./node_modules/**'])
		.pipe(rsync({
			hostname: server.hostname,
			username: server.username,
			destination: server.destination
		}));
})

gulp.task('watch', function () {
	gulp.watch(path.scss.src + '**/*.scss', ['scss']);
});