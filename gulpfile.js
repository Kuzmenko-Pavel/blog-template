'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var stripCssComments = require('gulp-strip-css-comments');
var requirejs = require('requirejs');
var amdclean = require('amdclean');
var fs = require('fs');

gulp.task('sass', function () {
    return gulp.src('./scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        // .pipe(stripCssComments())
        .pipe(concat('style.css'))
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

gulp.task('js', function () {
    requirejs.optimize({
        baseUrl: './js/',
        include: ['app'],
        out: './main.js',
        removeCombined: true,
        findNestedDependencies: true,
        preserveLicenseComments: false,
        wrap: true,
        optimize: 'uglify2',
        // optimize: 'none',
        uglify2: {
            output: {
                beautify: false,
                quote_keys: true,
                screw_ie8: false,
                ascii_only: true
            },
            compress: {
                unsafe: true,
                comparisons: true,
                cascade: true,
                collapse_vars: true,
                reduce_vars: true,
                warnings: true,
                loops: true,
                properties: true,
                screw_ie8: false,
                sequences: true,
                dead_code: true,
                conditionals: true,
                booleans: true,
                unused: true,
                if_return: true,
                join_vars: true,
                drop_console: true,
                passes: 3
            },
            warnings: true,
            verbose: true,
            mangle: {
                screw_ie8: false,
                toplevel: true,
                sort: true,
                eval: true,
                props: true


            },
            ie8: true
        },
        generateSourceMaps: false,
        useStrict: true,
        onModuleBundleComplete: function(data) {
            var outputFile = data.path;
            fs.writeFileSync(outputFile, amdclean.clean({
                'filePath': outputFile
            }));
        }
    });
});

gulp.task('js:watch', function () {
    gulp.watch('./js/**/*.js', ['js']);
});