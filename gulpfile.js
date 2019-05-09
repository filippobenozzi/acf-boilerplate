var babelify = require('babelify');
var browserSync = require('browser-sync');
var browserify = require('browserify');
var buffer = require('vinyl-buffer');
var gulp = require('gulp');
var plugins = require('gulp-load-plugins');
var source = require('vinyl-source-stream');
var gutil = require('gulp-util');

/* ----------------- */
/* Path
/* ----------------- */

var themeName = gutil.env.theme;
var themeAssetPath = 'wp-content/themes/'+themeName+'/assets';

/* ----------------- */
/* Development
/* ----------------- */

gulp.task('development', ['scripts', 'styles'], () => {
    browserSync({
        'server': './',
        'snippetOptions': {
            'rule': {
                'match': /<\/body>/i,
                'fn': (snippet) => snippet
            }
        }
    });

    gulp.watch(themeAssetPath + '/src/sass/**/*.scss', ['styles']);
    gulp.watch(themeAssetPath + '/src/js/**/*.js', ['scripts']);
    gulp.watch('./*.php', browserSync.reload);
});


/* ----------------- */
/* Scripts
/* ----------------- */

gulp.task('scripts', () => {
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

gulp.task('styles', () => {
    return gulp.src(themeAssetPath + '/src/sass/**/*.scss')
        .pipe(plugins().sourcemaps.init())
        .pipe(plugins().sass().on('error', plugins().sass.logError))
        .pipe(plugins().sourcemaps.write())
        .pipe(gulp.dest(themeAssetPath + '/dist/css'))
        .pipe(browserSync.stream());
});


/* ----------------- */
/* HTML
/* ----------------- */

// gulp.task('html', ['cssmin'], () => {
//     return gulp.src('index.html')
//         .pipe(critical.stream({
//             'base': 'build/',
//             'inline': true,
//             'extract': true,
//             'minify': true,
//             'css': ['./build/css/style.css']
//         }))
//         .pipe(gulp.dest('build'));
// });


/* ----------------- */
/* Cssmin
/* ----------------- */

gulp.task('cssmin', () => {
    return gulp.src(themeAssetPath + '/src/sass/**/*.scss')
        .pipe(plugins().sass({
            'outputStyle': 'compressed'
        }).on('error', plugins().sass.logError))
        .pipe(gulp.dest(themeAssetPath + '/dist/css'));
});


/* ----------------- */
/* Jsmin
/* ----------------- */

gulp.task('jsmin', () => {
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
/* Taks
/* ----------------- */

gulp.task('default', ['development']);
gulp.task('deploy', ['cssmin', 'jsmin']);