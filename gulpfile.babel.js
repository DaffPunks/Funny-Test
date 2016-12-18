'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const babel = require('gulp-babel');

var paths = {
    style: 'assets/sass/**/*.scss',
    styleIndex: 'assets/sass/style.scss',
    script: 'assets/js/**/*.js',
    src: 'public/',
    npmJS: ['node_modules/jquery/dist/jquery.min.js'],
    npmCSS: ['node_modules/bootstrap/dist/css/bootstrap.min.css']
};

gulp.task('sass', function () {
    gulp.src(paths.styleIndex)
        .pipe(sass())
        .pipe(gulp.dest(paths.src + 'css'));
});

gulp.task('js', () => {
    gulp.src(paths.script)
        .pipe(babel())
        .pipe(gulp.dest(paths.src + 'js'));
});

gulp.task('watch', function () {
    gulp.watch([paths.style, paths.script], ['sass', 'js']);
});

gulp.task('libs', () => {
    gulp.src(paths.npmCSS)
        .pipe(gulp.dest(paths.src + 'css'));
    gulp.src(paths.npmJS)
        .pipe(gulp.dest(paths.src + 'js'));
});

gulp.task('default', ['libs', 'sass', 'js', 'watch']);

