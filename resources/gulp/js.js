import webpack from 'webpack';
import {devConfig, proConfig} from './webpack.config';
import gulp from 'gulp';

gulp.task('js:dev', function (cb) {
  webpack(devConfig, cb);
});

gulp.task('js:production', function (cb) {
  webpack(proConfig, cb)
});

gulp.task('js', ['js:dev', 'js:production']);
