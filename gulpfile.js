var gulp = require("gulp")
var browserSync = require("browser-sync")
var stylus = require("gulp-stylus")
var postcss = require("gulp-postcss")
var autoprefixer = require("autoprefixer")

gulp.task("watch", ["browserSync", "styles-dev"], () => {
	gulp.watch("./app/Resources/views/**/*.twig", browserSync.reload)
	gulp.watch("./app/Resources/styles/**/*.styl", ["styles-dev"])
	gulp.watch("./web/styles/*.css", browserSync.reload)
})

gulp.task("browserSync", () => {
	browserSync.init({
		proxy: "localhost:8000"
	})
})

gulp.task("styles-dev", () => {
	return gulp.src("./app/Resources/styles/**/*.styl")
		.pipe(stylus())
		.pipe(postcss([ autoprefixer() ]))
		.pipe(gulp.dest("./web/styles"))
})