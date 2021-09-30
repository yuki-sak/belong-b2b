// package
const gulp = require('gulp');
const sass = require('gulp-sass');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const changed = require('gulp-changed');
const postcss = require('gulp-postcss');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('autoprefixer');
const mqpacker = require('css-mqpacker');
const sassglob = require('gulp-sass-glob');
const mmq = require('gulp-merge-media-queries');


// origin path
const originPath = 'assets/';

// path
const cssDir = originPath + 'css2';
const scssDir = originPath + 'scss';
const cssFile = originPath + 'css/**/*.css';
const scssFile = originPath + 'scss/**/*.scss';

// styleCompile
const styleCompile = () => {
  return gulp
    .src(scssFile)
    .pipe(sourcemaps.init())
    .pipe(changed(cssDir))
    .pipe(
      plumber({
        errorHandler: notify.onError('<%= error.message %>'),
      }),
    )
    .pipe(sassglob())
    .pipe(
      sass({
        outputStyle: 'expanded',
      }),
    )
    .pipe(sourcemaps.write())
    .pipe(
      postcss([
        autoprefixer({
          cascade: false,
        })
      ])
    )
    .pipe(gulp.dest(cssDir));
}

// styleOrganize
const styleOrganize = () => {
  return gulp
    .src(cssFile)
    .pipe(
      postcss([
        mqpacker()
      ])
    )
    .pipe(mmq({ log: false }))
    .pipe(cleanCSS())
    .pipe(gulp.dest(cssDir));
}

// taskWatch
const taskWatch = (cb) => {
  gulp.watch(scssFile, styleCompile);
  gulp.watch(scssFile).on('unlink', (path) => syncDel(path, 'scss'));
  cb();
}

// exports
exports.default = gulp.series(styleCompile, taskWatch);
exports.comp = styleOrganize;