var gulp = require('gulp'),
  rename = require('gulp-rename'),
  watch = require('gulp-watch'),
  minify = require('gulp-minify'),
  browserSync = require('browser-sync').create(),
  postcss = require('gulp-postcss'),
  autopre = require('autoprefixer'),
  csswring = require('csswring'),
  sass = require('gulp-sass'),
  uglify = require('gulp-uglify');


var url = 'http://localhost/gcpa';

gulp.task('watch', function () {
  browserSync.init({
    proxy: url,
    ghostMode: false
  });
  watch('./js/*.js', gulp.series('scripts'));
  watch('./styles/**/*.scss', gulp.series('styles'));
  watch('./backend-styles/*.scss', gulp.series('admin-styles'));

  watch('./**/*.php', function (done) {
    browserSync.reload();
    done;
  });
});

gulp.task('scripts', function () {
  return gulp.src('./js/scripts.js')
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('js'));
});

gulp.task('load', function () {
  browserSync.reload();
});

gulp.task('styles-o', function () {
  watch(['./styles/**/*.scss', '!./styles/backend-styles/*.scss'], gulp.series('styles', 'admin-styles'));
});

gulp.task('styles', function (done) {

  return gulp.src('./styles/main.scss')
    .pipe(sass())
    .pipe(postcss([autopre]))
    .pipe(gulp.dest('./styles'))
    .pipe(postcss([csswring]))
    .pipe(rename({
      basename: 'main.min'
    }))
    .pipe(gulp.dest('./styles'))
    .pipe(browserSync.stream());
  done();
});

gulp.task('admin-styles', function (done) {
  return gulp.src('./backend-styles/admin-main.scss')
    .pipe(sass())
    .pipe(postcss([autopre]))
    .pipe(gulp.dest('./backend-styles'))
    .pipe(postcss([csswring]))
    .pipe(rename({
      basename: 'admin-main.min'
    }))
    .pipe(gulp.dest('./backend-styles'))
    .pipe(browserSync.stream());
  done();
});



gulp.task('default', function (done) {
  console.log('Default Working');
  done();
});