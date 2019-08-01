import buffer from 'vinyl-buffer';
import chalk from 'chalk';
import gulp from 'gulp';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';

const log = console.log;

/**
 * Function to uglify all JavaScript files in a dist directory.
 *
 * @param {Object} atts - An Object of file properties.
 * @param {function} cb - The pipe sequence that gulp should run.
 * @returns {void}
 */
gulp.task('uglify', () => {
  log(chalk.yellowBright('--- Uglifying the JS ---'));

  return gulp.src(['./dist/js/*.js', '!./dist/js/*.min.js'])
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./dist/js'));
});
