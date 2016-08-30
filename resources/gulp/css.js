import gulp from 'gulp';
import {log} from 'gulp-util';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCss from 'gulp-clean-css';

const dest = 'public/css';
gulp.task('css', function () {
  gulp.src('resources/assets/sass/**/*.scss')
    .pipe(sass())
    .on('error', log)
    .pipe(gulp.dest(dest))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(cleanCss())
    .pipe(gulp.dest(dest));
});