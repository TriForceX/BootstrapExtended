/*
 * Gulpfile JavaScript/CSS File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */

//Main assets folder
var jsUrl = '/assets';
//Replacements
var replacementsCSS = [
	//Global
	['@global-url'	, jsUrl],
	//Screen
	['@screen-xs'	, '480px'], 
	['@screen-sm'	, '768px'], 
	['@screen-md'	, '992px'], 
	['@screen-lg'	, '1200px'],  
	['@screen-xl'	, '1920px'],  
];
var replacementsJS = [
	//Global
	['@global-url'	, jsUrl],
	//Screen
	['@screen-xs'	, '480'], 
	['@screen-sm'	, '768'], 
	['@screen-md'	, '992'], 
	['@screen-lg'	, '1200'],  
	['@screen-xl'	, '1920'],  
];

//Replace back-end files
/*var gulpBackCSSFiles = [];

var gulpBackJSFiles = [];*/

//Replace front-end files
var gulpFrontCSSFiles = [
						'resources/assets/css/style-base.css',
						'resources/assets/css/style-bootstrap.css',
						'resources/assets/css/style-fonts.css',
						'resources/assets/css/style-theme.css',
						'resources/assets/css/style-example.css', //Example file
						];
					
var gulpFrontJSFiles = [
						'resources/assets/js/app-lang.js',
						'resources/assets/js/app-base.js',
						'resources/assets/js/app-ready.js',
						'resources/assets/js/app-load.js',
						'resources/assets/js/app-responsive.js',
						'resources/assets/js/app-theme.js',
						'resources/assets/js/app-example.js', //Example file
						];

/*
 * Elixir Asset Management for Backend
 *
 * Install using: npm install --no-optional bower
 * Install using: bower install
 * Install using: npm install --save-dev laravel-elixir
 * Install using: npm install --save-dev laravel-elixir-replace
 *
 */

var elixir = require('laravel-elixir');

require('laravel-elixir-replace');

//Parse back-end files
/*elixir(function(mix){
	
	console.log('[ -------- CSS & JS Compile (Backend) -------- ]');
	
	mix.less('app.less')
		.coffee('app.coffee')
		.scripts(gulpBackJSFiles, 'public/js/vendor.js')
		.styles(gulpBackCSSFiles, 'public/css/vendor.css');
});*/

//Parse front-end Files
elixir(function(mix){
	
	console.log('[ -------- CSS & JS Compile (Frontend) -------- ]');
	
	mix.styles(gulpFrontCSSFiles, 'public/assets/css')
		.scripts(gulpFrontJSFiles, 'public/assets/js')
		.replace('public/assets/css/all.css', replacementsCSS)
		.replace('public/assets/js/all.js', replacementsJS);
	
});

/*
 * Custom Watch Method for Frontend
 *
 * Install using: npm install --no-optional gulp
 * Install using: npm install --no-optional --save-dev gulp-batch-replace
 * Install using: npm install --no-optional --save-dev gulp-concat
 *
 */

var gulp = require('gulp');
var replaceBatch = require('gulp-batch-replace');
var concat = require('gulp-concat');

var taskCSS = function(){

	console.log('[ -------- CSS Detected -------- ]');
	
	return gulp.src(gulpFrontCSSFiles) 
			   .pipe(replaceBatch(replacementsCSS))
			   .pipe(concat('all.css'))
			   .pipe(gulp.dest('public/assets/css'));
};

var taskJS = function(){

	console.log('[ -------- JS Detected -------- ]');
	
	return gulp.src(gulpFrontJSFiles) 
			   .pipe(replaceBatch(replacementsJS))
			   .pipe(concat('all.js'))
			   .pipe(gulp.dest('public/assets/js'));
};

gulp.task('watch', function(){
	
  console.log('[ -------- Starting Watch CSS & JS -------- ]');

  gulp.watch(gulpFrontCSSFiles, taskCSS); // Watch .css files
  gulp.watch(gulpFrontJSFiles, taskJS); // Watch .js files

});
