var gulp = require('gulp'),
	compass = require("gulp-compass"),
	notify = require("gulp-notify"),
 	cleanCSS = require('gulp-clean-css');


/**
 * Primary Compass Configurations
 * Note that all settings besides css_dir and sass_dir can just go in config.rb.
 */
var compassConfig = {
	css: 'sass/',     // Must match css_dir value in config.rb.
	sass: 'sass/',     	  // Must match sass_dir value in config.rb
	config_file: 'config.rb',
	sourcemap: true
};

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

// Compile SASS

gulp.task('compassBuild', function() {
	return gulp.src(files.sass.toCompile)
		.pipe(
			compass(compassConfig)
			.on('error', notify.onError({
				message: 'Sass/Compass failed. Check console for errors.'
			}))
			.on('error', function(error) {
				console.log(error); // find the error about
				this.emit('end');
			})
		)
		.pipe(gulp.dest('./' + compassConfig.css))
		.pipe(notify('Sass/Compass successfully compiled'));
});

// Minify CSS

gulp.task('minify-css', () => {
  return gulp.src('sass/style.css')
	.pipe( cleanCSS() ) // minify the css 
    .pipe(gulp.dest('site/css/'));
});


// Default task (one-time build).
gulp.task('default', ['compassBuild', 'minify-css']);


// Gulp Watcher if there is any change on SCSS file.
gulp.watch(files.sass.toCompile, ['default']);
