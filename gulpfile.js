const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const del = require('del');
 
const paths = {
  styles: {
    src: 'assets/src/styles/**/*.scss',
    dest: 'assets/dist/css/'
  },
  scripts: {
    src: 'assets/src/js/**/*.js',
    dest: 'assets/dist/js/'
  }
};
 

function clean() {
  return del([ 'assets/dist' ]);
}

function styles() {
  return gulp.src(paths.styles.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    // pass in options to the stream
    .pipe(rename({
      basename: 'styles',
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.styles.dest));
}
 
function scripts() {
  return gulp.src(paths.scripts.src, { sourcemaps: true })
    .pipe(babel())
    .pipe(uglify())
    //.pipe(concat('main.min.js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.scripts.dest));
}
 
function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, styles);
}
 

const build = gulp.series(clean, gulp.series(styles, scripts));

exports.clean = clean;
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;
exports.build = build;

// Default task
exports.default = build;