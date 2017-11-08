// gulpfile
// Config for 'gulp' task runner - gulpjs.com
//
// Ref: https://markgoodyear.com/2014/01/getting-started-with-gulp/
// 
// Load plugins
// Here we list all the plugins we'll be using, alphabetically please :)
// All plugins will be installed via npm on user's system. 'npm install' will read 'package.json'
var gulp = require('gulp'),
    autoprefixer    = require('gulp-autoprefixer'),
    browsersync     = require('browser-sync').create(),
    concat          = require('gulp-concat'),
    minifycss       = require('gulp-clean-css'),
    imagemin        = require('gulp-imagemin'),
    notify          = require('gulp-notify'),
    path            = require('path'),
    rename          = require('gulp-rename'),
    less            = require('gulp-less'),
    sourcemaps      = require('gulp-sourcemaps');
    svgmin          = require('gulp-svgmin');
    svgstore        = require('gulp-svgstore');
    uglify          = require('gulp-uglify');
    wpPot          = require('gulp-wp-pot');
    projectURL      = '1finch.dev'; // Project URL. Could be something like localhost:8888.

// BrowserSync
gulp.task( 'browsersync', function() {
  browsersync.init( {

    // For more options
    // @link http://www.browsersync.io/docs/options/

    // Project URL.
    proxy: projectURL,

    // `true` Automatically open the browser with BrowserSync live server.
    // `false` Stop the browser from automatically opening.
    open: true,

    // Inject CSS changes.
    // Commnet it to reload browser for every CSS change.
    injectChanges: true,

    // Use a specific port (instead of the one auto-detected by Browsersync).
    // port: 7000,

  } );
});

// Process the main CSS file
// autoprefixer must preceed sourcemap, otherwise gulp will error
gulp.task('less-main', function () {
    return gulp.src('./src/less/main.less')
        .pipe(sourcemaps.init())
        .pipe(less({paths: ['./assets/css/']}))
        .pipe(autoprefixer())
        .pipe(minifycss())
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./assets/css/'))
        .pipe( browsersync.stream() ) // Reloads style.css if that is enqueued.
        .pipe(notify({message: 'less-main completed'}));
});

// Process the wp-editor-styles CSS file
gulp.task('less-wp-editor', function () {
    return gulp.src('./src/less/wp-editor.scss')
        .pipe(less())
        .pipe(autoprefixer())
        .pipe(minifycss())
        .pipe(gulp.dest('./assets/css'))
        .pipe(notify({message: 'less-wp-editor completed'}));
});

// Process the wp-login-styles CSS file
gulp.task('less-wp-login', function () {
    return gulp.src('./src/less/wp-login.less')
        .pipe(less())
        .pipe(autoprefixer())
        .pipe(minifycss())
        .pipe(gulp.dest('./assets/css'))
        .pipe(notify({message: 'less-wp-login completed'}));
});

// Scripts task
// Combine all js files to a single file, output as minified & non-minified
gulp.task('scripts', function () {
    return gulp.src([
            'src/js/plugins/slick.js',
            'src/js/plugins/google-map-init.js',
            // 'src/js/lib/jquery.accordion.js',
            // 'src/js/lib/jquery.magnific-popup.js',
            'src/js/*.js'
        ])
        .pipe(concat('custom_scripts.js'))
        .pipe(gulp.dest('assets/js'))
        .pipe(uglify())
        .pipe(gulp.dest('assets/js'))
        .pipe(notify({
            message: 'scripts completed'
        }));
});


// Optimise images, lossless
// PNG, JPEG, GIF and SVG
gulp.task('image-optimise', function () {
    return gulp.src('./src/img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('./assets/img'))
         .pipe(notify({
            message: 'images optimised'
        }));
});

// Combine /img-src/*.svg into /img/icons.svg
gulp.task('svgstore', function () {
    return gulp
        .src('src/svg/*')
        .pipe(svgmin(function (file) {
            var prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: false
                    }
                }]
            }
        }))
        .pipe(rename({prefix: 'icon-'}))
        .pipe(svgstore())
        .pipe(rename({basename: "icons"}))
        .pipe(gulp.dest('assets/img/'));
});

// Copy fonts from src to assets
gulp.task('font-copy', function () {
    return gulp.src('./src/fonts/*')
        .pipe(gulp.dest('./assets/fonts'))
         .pipe(notify({
            message: 'fonts copied'
        }));
});

// Markup task
// Reload page when markup files are changed
gulp.task('markup', function() {
    return gulp.src('public/robots.txt')
});

// Default task
// What happens when user runs 'gulp'
gulp.task('default', function () {
    gulp.start('less-main', 'less-wp-editor', 'less-wp-login', 'image-optimise', 'svgstore', 'font-copy', 'scripts')
});

// SVG task
// SVG combination. Run 'gulp svg'.
gulp.task('svg', function () {
    gulp.start('svgstore')
});

// Generate .pot file
gulp.task('wppot', function () {
    return gulp.src('**/*.php')
        .pipe(wpPot({
            domain: 'finch',
            package: 'finch'
        }))
        .pipe(gulp.dest('lang/finch.pot'));
});


// Watch task
// What happens when user runs 'gulp watch'
gulp.task('watch', ['browsersync'], function () {

    // Watch .scss files
    gulp.watch('./src/less/**/*.less', ['less-main']);

    // Watch .js files
    gulp.watch('./src/js/**/*.js', ['scripts']);

    // Watch .php files
    gulp.watch('./*.php', ['markup']);

});