import gulp from 'gulp';

gulp.task('json', function () {
  gulp.src('resources/assets/json/**/*.json')
    .pipe('public/json');
});
