import {config} from 'laravel-elixir';
import gulp from 'gulp';


gulp.task('monitor', function () {
    gulp.watch([
      `${config.get('assets.css.sass.folder')}/**/*.scss`
    ], ['css']);

    gulp.watch([
      `${config.get('assets.js.folder')}/**/*.js`,
      `${config.get('assets.js.folder')}/**/*.vue`
    ], ['js']);

    gulp.watch([
      `${config.get('assets.images.folder')}/**/*.*`
    ], ['image']);
});