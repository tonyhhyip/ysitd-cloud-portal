import gulp from 'gulp';
import {config} from 'laravel-elixir'

gulp.task('json', function () {
  gulp.src(`${config.get('assets.json.folder')}/**/*.json`)
    .pipe(config.get('public.json.outputFolder'));
});
