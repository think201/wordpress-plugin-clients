var gulp    = require('gulp');
var watch   = require('gulp-watch');
var sass    = require('gulp-ruby-sass');
var uglify  = require('gulp-uglifyjs');

var cssDir  = 'assets/scss';
var jsDir   = 'assets/js';

gulp.task('watch', function () 
{
	gulp.watch(cssDir + '/**/*.scss', ['css']);
	gulp.watch(jsDir + '/**/*.js', ['js']);
   gulp.watch(jsDir + '/**/*.js', ['jsuser']);
}); 

gulp.task('css', function () 
{
   return sass(cssDir, {'style': 'compressed'})
  .pipe(gulp.dest('./public/css'));    	  
});

gulp.task('js', function () 
{
    gulp.src('assets/js/ct-admin.js')
    .pipe(uglify('ct-admin.js'))
    .pipe(gulp.dest('./public/js'));
});

gulp.task('jsuser', function () 
{
    gulp.src('assets/js/ct-user.js')
    .pipe(uglify('ct-user.js'))
    .pipe(gulp.dest('./public/js'));
});

gulp.task('default', ['css', 'js']); 