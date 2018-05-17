'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var rollup = require('gulp-rollup');

gulp.task('sass', function () {
    return gulp.src('./scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('style.css'))
        .pipe(sourcemaps.write('./'))
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