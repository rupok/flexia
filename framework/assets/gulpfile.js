var gulp = require('gulp'),
	compass = require("gulp-compass"),
 	cleanCSS = require('gulp-clean-css');


/**
 * Files and directories we reference in our tasks below. The "toCompile" properties
 * also generally contain patterns of files that are watched to trigger compilation.
 */
var files = {
	sass: {
		toCompile: ['sass/*.scss', 'sass/*/*.scss']
	}
};

// -------------
// Define Tasks.
// -------------

gulp.task('default', function() {
  // do nothing
});

gulp.task('minify-css', () => {
  return gulp.src('site/css/styles/*.css')
    .pipe(gulp.dest('dist'));
});

gulp.task('compass', function() {
  return gulp.src(files.sass.toCompile)
    .pipe(compass({
      config_file: 'config.rb',
      css: 'site/css/',
      sass: 'sass/'
    }))
    .pipe(gulp.dest('./' + compassConfig.css))
});



