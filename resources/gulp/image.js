import {config} from 'laravel-elixir';
import gulp from 'gulp';
import {log} from 'gulp-util';
import imagemin from 'gulp-imagemin';

gulp.task('image', function () {
  gulp.src(`${config.get('assets.images.folder')}/**/*.*`)
    .pipe(imagemin({
      progressive: true
    }))
    .on('error', log)
    .pipe(gulp.dest(config.get('public.images.outputFolder')));
});
