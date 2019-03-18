var gulp = require('gulp');
var sass = require('gulp-sass');

//gulp.task('hello', defaultTask);
gulp.task('hello', function() {
  console.log('Hello Zell');
});

gulp.task('sass', function(){
  return gulp.src('source-files')
    .pipe(sass()) // Using gulp-sass
    .pipe(gulp.dest('destination'))
});

gulp.task('sass', function(){
  return gulp.src('custom/app/scss/styles.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('custom/app/css'))
});



