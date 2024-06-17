// npm i --save-dev gulp gulp-cli gulp-sass sass  gulp-clean gulp-babel gulp-concat gulp-uglify gulp-rename gulp-clean-css del --force --verbose
const { src, dest, series, parallel, watch } = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');

function clean(cb) {
  // body omitted
  cb();
}

function css(cb) {
  return src(['src/scss/**/*.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(rename({
      basename: 'styles',
      suffix: '.min'
    }))
    .pipe(dest('dist/css/'));
}

function javascript(cb) {
  return src(['src/js/*.js'], { sourcemaps: true })
    .pipe(babel())
    //.pipe(src('vendor/*.js'))
    //.pipe(dest('output/'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('dist/js/'));
}


function watchTask() {
  watch('src/scss/**/*.scss', css);
  watch('src/js/**/*.js', series(clean, javascript));
};

exports.build = series(clean, css, javascript);
exports.watchTask = watchTask;
exports.javascript = javascript;
exports.css = css;
exports.default = watchTask;
