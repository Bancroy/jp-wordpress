var autoprefixer = require("gulp-autoprefixer");
var concat       = require("gulp-concat");
var cssnano      = require("gulp-cssnano");
var gulp         = require("gulp");
var gulpif       = require("gulp-if");
var gulpsync     = require("gulp-sync")(gulp);
var imagemin     = require("gulp-imagemin");
var jshint       = require("gulp-jshint");
var sass         = require("gulp-sass");
var scsslint     = require("gulp-scss-lint");
var sourcemaps   = require("gulp-sourcemaps");
var sync         = require("browser-sync").create();
var uglify       = require("gulp-uglify");
var util         = require("gulp-util");

gulp.task("compress-images", function () {
    return gulp.src("images/**")
               .pipe(imagemin({ multipass: true, optimizationLevel: 7 }))
               .pipe(gulp.dest("images"));
});

gulp.task("scripts", function () {
    return gulp.src(["scripts/libraries/*", "scripts/*"])
               .pipe(gulpif(util.env.development, sourcemaps.init()))
                .pipe(concat("script.js"))
               .pipe(gulpif(util.env.development, sourcemaps.write()))
               .pipe(gulp.dest("./"))
               .pipe(gulpif(util.env.development, sync.reload({ stream: true })));
});

gulp.task("scripts-lint", function () {
    return gulp.src("scripts/*")
               .pipe(jshint())
               .pipe(jshint.reporter("default"));
});

gulp.task("stylesheets", function () {
    return gulp.src("stylesheets/style.scss")
               .pipe(gulpif(util.env.development, sourcemaps.init()))
                .pipe(sass().on("error", sass.logError))
                .pipe(autoprefixer({ browsers: "> 0.1%", cascade: false }))
                .pipe(gulpif(util.env.production, cssnano()))
               .pipe(gulpif(util.env.development, sourcemaps.write()))
               .pipe(gulp.dest("./"))
               .pipe(gulpif(util.env.development, sync.stream()));
});

gulp.task("stylesheets-lint", function () {
    return gulp.src("stylesheets/**")
               .pipe(scsslint({ config: "scss-lint.yml" }));
});

gulp.task("build", gulpsync.sync(["stylesheets-lint", "stylesheets", "scripts-lint", "scripts"]));
gulp.task("watch", function () {
    sync.init({
        ghostMode: {
            clicks: true,
            location: true,
            forms: true,
            scroll: true
        },
        notify: false,
        proxy: "http://jp-wordpress.local"
    });

    gulp.watch("scripts/**", ["scripts-lint", "scripts"]);
    gulp.watch("stylesheets/**", ["stylesheets-lint", "stylesheets"]);
    gulp.watch(["*", "content/**", "images/**", "includes/**"]).on("change", sync.reload);
});