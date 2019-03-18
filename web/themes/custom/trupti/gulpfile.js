var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var imagemin = require('gulp-imagemin');
var changed = require('gulp-changed');



gulp.task('hello', function(done) {
    console.log('Hello trupti');
    done();
  });

gulp.task('reload',function(done){
  browserSync.reload();
  done();
})

// gulp.task('sass', function(){
//     return gulp.src('app/scss/**/*.scss')
//       .pipe(sass()) // Converts Sass to CSS with gulp-sass
//       .pipe(gulp.dest('css/style.css'))
//       .pipe(browserSync.stream());
//   });

  
  // const dev = gulp.series('sass','browser-sync','watch');
  // export default dev;
  


  gulp.task('browser-sync',function(){
    browserSync.init({
      open:'external',
      host:'localhost',
      proxy:'http://localhost:8886/drupal_new_dev/web/',
      
      
    });
  });
  gulp.task('sass', function() {
    return gulp.src('scss/**/*.scss') // Gets all files ending with .scss in app/scss
      .pipe(sass())
      .pipe(gulp.dest('css'))
      .pipe(browserSync.reload({
        stream: true
      }))
  });
  gulp.task('watch', gulp.parallel('browser-sync', function(){
    gulp.watch('scss/**/*.scss', gulp.series('sass')); 
    // Other watchers
  }));

  // gulp.task('dev',gulp.series('sass','browser-sync', gulp.parallel('watch', function(done){
    
  //   done();
  // })));
  
  gulp.task('imagemin', function(done) {
    var imgSrc = 'images/*.+(png|jpg|gif)',
    imgDst = 'trupti/dist/images';  
    gulp.src(imgSrc)
    .pipe(changed(imgDst))
    .pipe(imagemin())
    .pipe(gulp.dest(imgDst));
    done();
 });
 
 



  
  

  
  
  

  