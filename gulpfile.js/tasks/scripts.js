// ==== SCRIPTS ==== //
var gulp     = require('gulp'),
  browserify = require("browserify"),
  babelify = require("babelify"),
  source = require('vinyl-source-stream'),
  gutil = require('gulp-util'),
  config   = require('../gulpconfig');

gulp.task('scripts', function() {
  var files = [
    'app.js',
    'admin.js'
  ];

  return browserify({ debug: true })
    .transform(babelify)
    .bundle()
    .on('error',gutil.log)
    .pipe(source([
      'app.js',
      'admin.js'
    ]))
    .pipe(gulp.dest(config.path.dist+'js'));
});