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
    dest: 'dist/css/'
  },
  scripts: {
    src: 'assets/src/js/**/*.js',
    dest: 'dist/js/'
  }
};
 

function clean() {
  return del([ 'dist' ]);
}

function css() {
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
 
function javascript() {
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
 

const build = gulp.series(clean, gulp.series(css, javascript));

exports.clean = clean;
exports.css = css;
exports.javascript = javascript;
exports.watch = watch;
exports.build = build;

// Default task
exports.default = build;