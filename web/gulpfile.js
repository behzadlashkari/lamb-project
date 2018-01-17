var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');


gulp.task('styles', function() {
    gulp.src('sass/**/*.scss')
    .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))        
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./css/'))
});

//Watch task


gulp.task('default',function() {
    gulp.watch('sass/**/*.scss',['styles'])
});

// gulp.task('sass', function(){
//     gulp.src('sass/**/*.scss')
//         .pipe(autoprefixer('last 2 versions'))
//         .pipe(gulp.dest('./css/'))
// });
