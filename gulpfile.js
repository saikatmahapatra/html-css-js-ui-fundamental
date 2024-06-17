// npm i --save-dev gulp gulp-cli gulp-sass sass  gulp-clean gulp-babel gulp-concat gulp-uglify gulp-rename gulp-clean-css del --force --verbose
const { src, dest, series, parallel, watch } = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');

function clean() {
}

function css() {
  return src(['src/scss/**/*.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(rename({
      basename: 'styles',
      suffix: '.min'
    }))
    .pipe(dest('dist/css/'));
}

function javascript() {
  return src(['src/js/*.js'], { sourcemaps: true })
    .pipe(babel())
    //.pipe(src('vendor/*.js'))
    //.pipe(dest('output/'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('dist/js/'));
}

function copyAssets() {
  return src(['assets/images/**/*{.jpg, .png}'])
    .pipe(dest('dist/images/'));
}


function watchTask() {
  watch('src/scss/**/*.scss', css);
  watch('src/js/**/*.js', series(clean, javascript));
  watch('assets/**/', series(copyAssets));
};

exports.build = series(css, javascript);
exports.default = watchTask;
