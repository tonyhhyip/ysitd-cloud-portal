import gulp from 'gulp';
import './css';
import './js';
import './image';
import './monitor';
import './json'

gulp.task('build', ['css', 'js', 'image', 'json']);
gulp.task('dev', ['build', 'monitor']);
