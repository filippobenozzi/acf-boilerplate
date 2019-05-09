//
// End theme config
//

var gulp = require('gulp');
var gutil = require('gulp-util');
var jsImport = require('gulp-js-import');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var watch = require('gulp-watch');
var sourcemaps = require('gulp-sourcemaps');
var stripCssComments = require('gulp-strip-css-comments');
var rev = require('gulp-rev');
var revDel = require('rev-del');
var inject = require('gulp-inject-string');
var browserSync = require('browser-sync').create();

//
//  Theme config
//

var theme_name = gutil.env.theme;


gulp.task('watch_env', ['sass', 'scripts', 'watch']);
gulp.task('prod', ['sass_production','scripts_production']);


gulp.task('sass', function () {
    gulp.src('wp-content/themes/'+theme_name+'/assets'+'/src/sass/**/*.scss')
        .pipe(sass({
            sourceComments: 'map',
            sourceMap: 'sass',
            outputStyle: 'nested'
        }).on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'+'/dist/css'));
});

gulp.task('scripts', function() {
    return gulp.src('wp-content/themes/'+theme_name+'/assets'+'/src/js/index.js')
        .pipe(jsImport({hideConsole: true}))
        .pipe(concat('bundle.js'))
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'+'/dist/js/'));
});

gulp.task('inject_browser_sync', function(){
    gulp.src('wp-content/themes/'+theme_name+'/'+'footer.php')
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/'));
});

gulp.task('watch', function () {
    gulp.watch('wp-content/themes/'+theme_name+'/assets'+'/src/sass/**/*.scss', ['sass']).on('change', browserSync.reload);
    gulp.watch('wp-content/themes/'+theme_name+'/assets'+'/src/js/**/*.js', ['scripts']).on('change', browserSync.reload);
});

gulp.task('browser-sync', function() {

    browserSync.init({
        proxy: 'vega.test',
        injectChanges: true
    });

});

gulp.task('sass_production', function () {
    gulp.src('wp-content/themes/'+theme_name+'/assets'+'/sass/**/*.scss')
        .pipe(sass({
            outputStyle: 'nested'
        }).on('error', sass.logError))
        .pipe(rev())
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'+'/css'))
        .pipe(rev.manifest('wp-content/themes/'+theme_name+'/assets'+'/rev-manifest.json',{
            base: 'wp-content/themes/'+theme_name+'/assets',
            merge: true
        }))
        .pipe(revDel('wp-content/themes/'+theme_name+'/assets'+'/rev-manifest.json'))
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'));
});

gulp.task('scripts_production', function() {
    return gulp.src(scripts_array)
        .pipe(concat('all.js'))
        .pipe(rev())
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'+'/js/'))
        .pipe(rev.manifest('wp-content/themes/'+theme_name+'/assets'+'/rev-manifest.json',{
            base: 'wp-content/themes/'+theme_name+'/assets',
            merge: true
        }))
        .pipe(revDel('wp-content/themes/'+theme_name+'/assets'+'/rev-manifest.json'))
        .pipe(gulp.dest('wp-content/themes/'+theme_name+'/assets'));
});