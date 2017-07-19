var gulp = require('gulp'),
	compass = require("gulp-compass"),
 	cleanCSS = require('gulp-clean-css');


gulp.task('default', function() {
  // do nothing
});

gulp.task('minify-css', () => {
  return gulp.src('site/css/styles/*.css')
    .pipe(gulp.dest('dist'));
});