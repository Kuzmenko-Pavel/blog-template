'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var rollup = require('gulp-rollup');
var cleanCSS = require('gulp-clean-css');
var merge = require('merge-stream');
var rename = require('gulp-rename');
var stripCssComments = require('gulp-strip-css-comments');

gulp.task('sass', function () {
    return gulp.src('./scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(stripCssComments())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./'))
        .pipe(stripCssComments({preserve: false}))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./scss/**/*.scss', ['sass']);
});

// gulp.task('js', function() {
//     gulp.src('./js/**/*.js')
//         .pipe(sourcemaps.init())
//         .pipe(rollup({
//             input: './js/main.js',
//             output: {
//                 format: 'iife'
//             }
//         }))
//         .pipe(sourcemaps.write('./'))
//         .pipe(gulp.dest('./'));
// });