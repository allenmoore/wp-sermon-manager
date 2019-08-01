import babelify from 'babelify';
import browserify from 'browserify';
import buffer from 'vinyl-buffer';
import chalk from 'chalk';
import gulp from 'gulp';
import gulpLog from 'gulplog';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import tap from 'gulp-tap';

const log = console.log;

/**
 * Function to compile all files in a src directory.
 *
 * @param {Object} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 *
 * @returns {void}
 */
gulp.task('compile-admin-js', () => {
  const opts = {
    dest: './dist/js',
    src: ['./src/js/admin-index.js']
  };

  log(chalk.white('--- Babelify all the JS ES6 ---'));

  return gulp.src(opts.src, {read: false})
    .pipe(tap((file) => {
     gulpLog.info('bundling' + file.path);
     file.contents = browserify(file.path, {debug: false}).transform(babelify).bundle();
    }))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps:true}))
    .pipe(rename('build.admin.js'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(opts.dest));
});
