// ==== STYLES ==== //

var gulp         = require('gulp'),
  	sass         = require('gulp-sass'),
  	autoprefixer = require('gulp-autoprefixer'),
  	cssnano      = require('gulp-cssnano'),
    config       = require('../gulpconfig'),
    plumber      = require('gulp-plumber');

gulp.task('styles', function() {
  /* Where scss figle come from */
  return gulp.src( config.path.src + 'scss/*.scss' )
  /* Prevent pipe breaking */
  .pipe(plumber(function(error){
      console.log("Error happend!", error.message);
      this.emit('end');
  }))
  /* SASS Config */
  .pipe( sass( {
    includePaths: [
      config.path.src + 'scss/'
    ],
    precision: 6,
    onError: function(err) {
      return console.log(err);
    }
  } ) )
  /* Config for autoprefixer */
  .pipe( autoprefixer( {
    add: true,
    browsers: ['> 3%', 'last 2 versions', 'ie 9', 'ios 6', 'android 4']
  } ) )
  /* Minify files */
  .pipe( cssnano() )
  /* Where the dist file is put */
  .pipe( gulp.dest( config.path.dist + 'css/' ) );
});
