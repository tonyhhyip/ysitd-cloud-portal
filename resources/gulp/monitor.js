import gulp from 'gulp';


gulp.task('monitor', function () {
  gulp.watch([
    'resources/assets/sass/**/*.scss'
  ], ['css']);

  gulp.watch([
    'resources/assets/js/**/*.js',
    'resources/assets/js/**/*.vue'
  ], ['js']);

  gulp.watch([
    'resources/assets/images/**/*.*'
  ], ['image']);

  gulp.watch([
    'resources/assets/json/**/*.json'
  ], ['json'])
});