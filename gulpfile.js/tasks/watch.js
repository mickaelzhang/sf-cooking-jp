// ==== WATCH ==== //

var gulp   = require('gulp'),
    config = require('../gulpconfig');

gulp.task('watch', function() {
  gulp.watch(config.path.src + 'scss/**/*.scss', ['styles']);
  gulp.watch(config.path.src + 'js/**/*.js', ['scripts']);
  gulp.watch(config.path.src + 'img/**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)', ['images']);
});
