const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const babelify = require('babelify');
const browserify = require('browserify');
const buffer = require('vinyl-buffer');
const source = require('vinyl-source-stream');
const uglify = require('gulp-uglify');
const imagemin = require('gulp-imagemin');

const sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed',
};

gulp.task('sass_web', () =>
  gulp
    .src('./app/src/WebBundle/Resources/assets/sass/main.scss')
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./web/css')));

gulp.task('watch', () => {
  gulp
    .watch('./app/src/**/*.scss', ['sass_web']);
  gulp
    .watch('./app/src/**/*.js', ['js_web']);
});

gulp.task('img_web', () =>
  gulp
    .src('./app/src/WebBundle/Resources/assets/img/*')
    .pipe(imagemin())
    .pipe(gulp.dest('./web/img')),
);

gulp.task('js_web', () => {
  const bundler = browserify('./app/src/WebBundle/Resources/assets/js/chat.js');
  bundler.transform(babelify);

  bundler.bundle()
    .on('error', () => {})
    .pipe(source('chat.js'))
    .pipe(buffer())
    .pipe(uglify()) // Use any gulp plugins you want now
    .pipe(gulp.dest('./web/js'));
});

gulp.task('build', ['js_web', 'sass_web']);
gulp.task('default', ['js_web', 'sass_web', 'watch_sass']);
