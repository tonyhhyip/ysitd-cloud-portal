import gulp from 'gulp';
import {log} from 'gulp-util';
import imagemin from 'gulp-imagemin';

gulp.task('image', function () {
  gulp.src('resources/assets/images/**/*.*')
    .pipe(imagemin({
      progressive: true
    }))
    .on('error', log)
    .pipe(gulp.dest('public/images'));
});
