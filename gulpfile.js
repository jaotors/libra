const elixir = require('laravel-elixir');

process.env.DISABLE_NOTIFIER = true;

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

gulp.task("fonts", function() {
    gulp.src('node_modules/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest('public/fonts'));
    gulp.src('node_modules/raleway-webfont/fonts/*')
        .pipe(gulp.dest('public/fonts'));
});

gulp.task("js", function() {
    gulp.src('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js')
        .pipe(gulp.dest('public/js'));
    gulp.src('node_modules/jquery/dist/jquery.min.js')
        .pipe(gulp.dest('public/js'));
    gulp.src('node_modules/datatables.net/js/jquery.dataTables.js')
        .pipe(gulp.dest('public/js'));
    gulp.src('resources/assets/js/scripts.js')
        .pipe(gulp.dest('public/js'));
});

gulp.task("images", function() {
    gulp.src('resources/assets/images/*')
        .pipe(gulp.dest('public/images'));
});

elixir((mix) => {
    mix.task('js');
    mix.task('fonts');
    mix.task('images');
    mix.sass('app.scss')
       .webpack('app.js');
});
