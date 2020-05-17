const { src, dest, series, watch } = require('gulp');
const compass = require('gulp-compass');
const notify = require('gulp-notify');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');

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

function compassBuild() {
	return src( files.sass.toCompile ).pipe( 
		compass(compassConfig).on( 'error', notify.onError({
			message: 'Sass/Compass failed. Check console for errors.'
		}) ).on('error', function(error) {
			console.log(error); // find the error about
			this.emit('end');
		})
	)
	.pipe(autoprefixer())
	.pipe( dest( './' + compassConfig.css ) )
	.pipe( notify( 'Sass/Compass successfully compiled' ) );
}

// Minify CSS
function minifyCSS() {
	return src('sass/style.css')
		.pipe( cleanCSS() ) // minify the css 
		.pipe( dest( 'site/css/' ) );
}
exports.default = function(){
	watch(files.sass.toCompile, series( minifyCSS, compassBuild ) )
};
exports.build = series( compassBuild, minifyCSS );
