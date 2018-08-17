const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('styles', function () {
    gulp.src('sass/estilos.css')
        .pipe( autoprefixer({
            browsers: ['last 2 versions'],
        }) )
        .pipe(gulp.dest('css'))
});

gulp.task('watch', function () {
    gulp.watch('sass/estilos.css', ['styles']);
});

