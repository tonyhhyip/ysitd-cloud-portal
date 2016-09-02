import fs from 'fs';
import webpack from 'webpack';
import {devConfig, proConfig} from './webpack.config';
import gulp from 'gulp';
import {log, PluginError} from 'gulp-util';

gulp.task('js:dev', function (cb) {
  webpack(devConfig, function (e, stats) {
    if (e) {
      throw new PluginError('[webpack]', e);
    } else {
      log('[webpack]', stats.toString({
        version: true,
        timings: true,
        assets: true,
        chunks: true,
        chunkModules: true,
        modules: true
      }));
      fs.writeFile('storage/app/webpack.json', JSON.stringify(stats.toJson('verbose')));
    }
    cb();
  });
});

gulp.task('js:production', function (cb) {
  webpack(proConfig, cb)
});

gulp.task('js', ['js:dev', 'js:production']);
