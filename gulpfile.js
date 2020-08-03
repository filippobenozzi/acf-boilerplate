var babelify = require('babelify');
var browserSync = require('browser-sync');
var browserify = require('browserify');
var buffer = require('vinyl-buffer');
var gulp = require('gulp');
var sass = require("gulp-sass");
var plugins = require('gulp-load-plugins');
var source = require('vinyl-source-stream');
var gutil = require('gulp-util');
require('dotenv').config({path: '.env.local'});
require('dotenv').config({path: '.env'});

var packageImporter = require('node-sass-package-importer');

/* ----------------- */
/* Path
/* ----------------- */

var themeName = process.env.THEME_NAME;
var urlSite = process.env.LOCAL_DOMAIN;
var themeAssetPath = 'wp-content/themes/'+themeName+'/assets';

/* ----------------- */
/* Scripts
/* ----------------- */

gulp.task('scripts', function () {
    return browserify({
        'entries': [themeAssetPath + '/src/js/main.js'],
        'debug': true,
        'transform': [
            babelify.configure({
                'presets': ['es2015', 'react']
            })
        ]
    })
        .bundle()
        .on('error', function () {
            var args = Array.prototype.slice.call(arguments);

            plugins().notify.onError({
                'title': 'Compile Error',
                'message': '<%= error.message %>'
            }).apply(this, args);

            this.emit('end');
        })
        .pipe(source('bundle.js'))
        .pipe(buffer())
        .pipe(plugins().sourcemaps.init({'loadMaps': true}))
        .pipe(plugins().sourcemaps.write('.'))
        .pipe(gulp.dest(themeAssetPath + '/dist/js/'))
        .pipe(browserSync.stream());
});


/* ----------------- */
/* Styles
/* ----------------- */

gulp.task('styles', function() {
    return gulp.src(themeAssetPath + '/src/sass/**/*.scss')
        .pipe(plugins().sourcemaps.init())
        .pipe(sass({importer: packageImporter()}).on('error', sass.logError))
        .pipe(plugins().sourcemaps.write())
        .pipe(gulp.dest(themeAssetPath + '/dist/css'))
        .pipe(browserSync.stream());
});

/* ----------------- */
/* Cssmin
/* ----------------- */

gulp.task('cssmin', function() {
    return gulp.src(themeAssetPath + '/src/sass/**/*.scss')
        .pipe(sass({
            'outputStyle': 'compressed',
            importer: packageImporter()
        }).on('error', sass.logError))
        .pipe(gulp.dest(themeAssetPath + '/dist/css'));
});


/* ----------------- */
/* Jsmin
/* ----------------- */

gulp.task('jsmin', function() {
    var envs = plugins().env.set({
        'NODE_ENV': 'production'
    });

    return browserify({
        'entries': [themeAssetPath + '/src/js/main.js'],
        'debug': false,
        'transform': [
            babelify.configure({
                'presets': ['es2015', 'react']
            })
        ]
    })
        .bundle()
        .pipe(source('bundle.js'))
        .pipe(envs)
        .pipe(buffer())
        .pipe(plugins().uglify())
        .pipe(envs.reset)
        .pipe(gulp.dest(themeAssetPath + '/dist/js/'));
});

/* ----------------- */
/* Development
/* ----------------- */

gulp.task('development', function(done) {

    browserSync({
        proxy: urlSite,
        'snippetOptions': {
            'rule': {
                'match': /<\/body>/i,
                'fn': (snippet) => snippet
            }
        }
    });

    gulp.watch(themeAssetPath + '/src/sass/**/*.scss', gulp.series('styles'));
    gulp.watch(themeAssetPath + '/src/js/**/*.js', gulp.series('scripts'));
    gulp.watch('wp-content/themes/**/*.php', browserSync.reload);
    done();
});

/* ----------------- */
/* Taks
/* ----------------- */

gulp.task('default', gulp.series('development'));
gulp.task('deploy', gulp.series('cssmin', 'jsmin'));
