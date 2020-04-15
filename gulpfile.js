// Gulp build confg file
"use strict";
const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');
//const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const imagemin = require('gulp-imagemin');
const newer = require('gulp-newer');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const eslint = require('gulp-eslint');
const pipeline = require('readable-stream').pipeline;

// source, destination path
const path = {
    build_dist: './dist',
    css: { src: './src/scss/**/*.scss', dest: './dist/css' },
    js: { src: './src/js/**/*.js', dest: './dist/js' },
    img: { src: './src/img/**/*', dest: './dist/img' }
};

// delete existing dist folder
function clean_build() {
    return del([path.build_dist]);
}

// scss to css
function css() {
    return gulp.src(path.css.src)
        .pipe(sourcemaps.init())
        .pipe(sass.sync({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write('.'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(path.css.dest));
}

// minify css with .min.css
// function minify_css() {
//     return gulp.src([path.css.dest + '/styles.css'])
//         .pipe(cleanCSS({ compatibility: 'ie8', debug: true }, (details) => {
//             console.log(`${details.name}: ${details.stats.originalSize}`);
//             console.log(`${details.name}: ${details.stats.minifiedSize}`);
//         }))
//         .pipe(rename({ suffix: '.min' }))
//         .pipe(gulp.dest(path.css.dest));
// }

// optimize images
function img() {
    return gulp
        .src(path.img.src)
        .pipe(newer(path.img.dest))
        .pipe(
            imagemin()
        )
        .pipe(gulp.dest(path.img.dest));
}

// minify js
function js() {
    return pipeline(
        gulp.src(path.js.src),
        uglify(),
        //gulp.pipe(concat('scripts.js')),
        rename({ suffix: '.min' }),
        gulp.dest(path.js.dest),

    );
}

// js lint
function js_lint() {
    return gulp
        .src([path.js.src])
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

// detect file change and perform specific task
function watch_file_changes() {
    gulp.watch(path.css.src, gulp.series(css));
    gulp.watch(path.js.src, gulp.series(js));
    gulp.watch(path.img.src, gulp.series(img));
}

// exports tasks
const cleanBuildTask = gulp.series(clean_build);
exports.clean = cleanBuildTask;

const buildTask = gulp.series(clean_build, gulp.series(css, js, img));
exports.build = buildTask;

const cssTask = gulp.series(css);
exports.css = cssTask;

const imgOptimizeTask = gulp.series(img);
exports.img = imgOptimizeTask;

const jsOptimizeTask = gulp.series(js);
exports.js = jsOptimizeTask;

const watchTask = gulp.parallel(watch_file_changes);
exports.watch = watchTask;
exports.default = buildTask;