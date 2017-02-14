// ==== SCRIPTS ==== //
var gulp     = require('gulp'),
    browserify = require("browserify"),
    babelify = require("babelify"),
    source = require('vinyl-source-stream'),
    gutil = require('gulp-util'),
    config   = require('../gulpconfig'),
    uglify = require('gulp-uglify'),
    streamify = require('gulp-streamify');

gulp.task('scripts', function() {
  var bundleStream = browserify('app/Resources/assets/js/main.js').transform(babelify).bundle()

  bundleStream
    .on('error', function (err) {
      console.log(err.toString());
      this.emit("end");
    })
    .pipe(source('main.js'))
    .pipe(streamify(uglify()))
    .pipe(gulp.dest(config.path.dist+'js'));
});