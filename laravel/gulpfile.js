/*
 * Gulpfile JavaScript/CSS File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     http://dev.gznetwork.com/websitebase
 * Issues:   https://github.com/triforcex/websitebase
 * 
 */

var jsUrl = '/assets';
var jsLang = 1; //0 = English, 1 = Spanish
var replacementsCSS = [
	//Screen
	['@screen-small-phone' 	, '320px'], 
	['@screen-medium-phone' , '360px'],
	['@screen-phone' 		, '480px'],
	['@screen-tablet' 		, '768px'],
	['@screen-desktop' 		, '992px'],  
	['@screen-widescreen' 	, '1200px'], 
	['@screen-full-hd' 		, '1920px'], 
	//Global
	['@global-url' , jsUrl],
	//Custom
	['@color-azul' 			, '#385086'], 
	['@color-dorado' 		, '#ca9e64'], 
	['@color-rojo' 			, '#d70000'], 
	['@color-borde' 		, '#a0a0a0'], 
	['@color-negro' 		, '#333333'], 
	['@color-gris' 			, '#666666'], 
];
var replacementsJS = [
	//Screen
	['@screen-small-phone' 	, '320'], 
	['@screen-medium-phone' , '360'],
	['@screen-phone' 		, '480'],
	['@screen-tablet' 		, '768'],
	['@screen-desktop' 		, '992'],  
	['@screen-widescreen' 	, '1200'], 
	['@screen-full-hd' 		, '1920'], 
	//Global
	['@global-url' , jsUrl],
	//Form Validation
	['@validate-title' 			, jsLang == 1 ? 'Alerta Formulario' : 'Form Alert'], 
	['@validate-normal' 		, jsLang == 1 ? 'Por favor complete los campos.' : 'Please fill the fields.'], 
	['@validate-number'	 		, jsLang == 1 ? 'Por favor escriba un número válido.' : 'Please type a valid number.'], 
	['@validate-tel' 			, jsLang == 1 ? 'Por favor escriba un teléfono válido.' : 'Please type a phone number.'], 
	['@validate-pass' 			, jsLang == 1 ? 'Por favor complete su clave.' : 'Please fill your password.'], 
	['@validate-email' 			, jsLang == 1 ? 'Por favor escriba un E-Mail válido.' : 'Please type a correct E-Mail.'],
	['@validate-search' 		, jsLang == 1 ? 'Por favor complete el campo de busqueda.' : 'Please fill the search field.'], 
	['@validate-checkbox' 		, jsLang == 1 ? 'Por favor elija opciones.' : 'Please check an option.'],
	['@validate-radio' 			, jsLang == 1 ? 'Por favor elija una de las opciones.' : 'Please check one of the options.'],
	['@validate-textarea' 		, jsLang == 1 ? 'Por favor escriba un mensaje.' : 'Please write a message.'],
	['@validate-select' 		, jsLang == 1 ? 'Por favor seleccione una opción.' : 'Please select an option.'],
	['@validate-confirm-title' 	, jsLang == 1 ? 'Confirmar Formulario' : 'Form Confirm'], 
	['@validate-confirm-text' 	, jsLang == 1 ? '¿Estas seguro de que deseas enviar el formulario?' : 'Are you sure you want to send the previous info?'], 
	//Video launch
	['@videolaunch-title' 		, jsLang == 1 ? 'Compartir Enlace' : 'Share Link'], 
	['@videolaunch-text' 		, jsLang == 1 ? '¡El enlace ha sido copiado!' : 'The share link has been copied!'],
	//Map launch
	['@maplaunch-title' 		, jsLang == 1 ? 'Mapa Dirección' : 'Map Select'],
	['@maplaunch-text' 			, jsLang == 1 ? 'Seleccione una de las opciones' : 'Select one of options below'],
	//Check disabled
	['@disabled-text' 			, jsLang == 1 ? 'Este contenido esta deshabilitado por el momento.' : 'This content is currently disabled.'],
	//Lightgallery
	['@lgtitle-prev' 			, jsLang == 1 ? 'Cargando página anterior ...' : 'Loading previous page ...'],
	['@lgtitle-next' 			, jsLang == 1 ? 'Cargando siguiente página ...' : 'Loading next page ...'],
	//Custom
	['@color-azul' 			, '#385086'], 
	['@color-dorado' 		, '#ca9e64'], 
	['@color-rojo' 			, '#d70000'], 
	['@color-borde' 		, '#a0a0a0'], 
	['@color-negro' 		, '#333333'], 
	['@color-gris' 			, '#666666'], 
];

var gulpBackCSSFiles = [
						'datatables.net-bs/css/dataTables.bootstrap.css',
						'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
						'cropper/dist/cropper.css',
						'photoswipe/dist/photoswipe.css',
						'bower_components/photoswipe/dist/default-skin/default-skin.css',
						'dropzone/dist/dropzone.css',
						'fullcalendar/dist/fullcalendar.css',
						'clockpicker/dist/bootstrap-clockpicker.css',
						'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
						];

var gulpBackJSFiles = [
						'jquery/dist/jquery.js',
						'bootstrap/dist/js/bootstrap.js',
						'datatables.net/js/jquery.dataTables.js',
						'datatables.net-bs/js/dataTables.bootstrap.js',
						'moment/min/moment.min.js',
						'moment/locale/es.js',
						'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
						'cropper/dist/cropper.js',
						'photoswipe/dist/photoswipe.js',
						'bower_components/photoswipe/dist/photoswipe-ui-default.js',
						'dropzone/dist/dropzone.js',
						'fullcalendar/dist/fullcalendar.js',
						'clockpicker/dist/bootstrap-clockpicker.js',
						'bootstrap-datepicker/dist/js/bootstrap-datepicker.js'
						];

var gulpFrontCSSFiles = [
						'resources/assets/css/style-base.css',
						'resources/assets/css/style-fonts.css',
						'resources/assets/css/style-theme-old.css',
						'resources/assets/css/style-theme.css'
						];
					
var gulpFrontJSFiles = [
						'resources/assets/js/app-base.js',
						'resources/assets/js/app-base-old.js',
						'resources/assets/js/app-ready.js',
						'resources/assets/js/app-load.js',
						'resources/assets/js/app-responsive.js'
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

elixir(function(mix){
	
	console.log('[ -------- Compilado CSS y JS (Backend) -------- ]');
	
	mix.less('app.less')
		.coffee('app.coffee')
		.scripts(gulpBackJSFiles, 'public/js/vendor.js', 'bower_components')
		.styles(gulpBackCSSFiles, 'public/css/vendor.css', 'bower_components')
		.copy('bower_components/bootstrap/dist/fonts/', 'public/fonts/')
		.copy('bower_components/photoswipe/dist/default-skin/', 'public/css/gallery/')
		.copy('bower_components/tinymce/', 'public/js/tinymce/');
});

elixir(function(mix){
	
	console.log('[ -------- Compilado CSS y JS (Frontend) -------- ]');
	
	mix.styles(gulpFrontCSSFiles, 'public/assets/css')
		.scripts(gulpFrontJSFiles, 'public/assets/js')
		.replace('public/assets/css/all.css', replacementsCSS)
		.replace('public/assets/js/all.js', replacementsJS);
	
});


/*
 * Custom Watch Method for Frontend
 *
 * Install using: npm install --no-optional --save-dev gulp-batch-replace
 * Install using: npm install --no-optional --save-dev gulp-concat
 *
 */

var gulp = require('gulp');
var replaceBatch = require('gulp-batch-replace');
var concat = require('gulp-concat');

var taskCSS = function(){

	console.log('[ -------- Detección en CSS -------- ]');
	
	return gulp.src(gulpFrontCSSFiles) 
			   .pipe(replaceBatch(replacementsCSS))
			   .pipe(concat('all.css'))
			   .pipe(gulp.dest('public/assets/css'));
};

var taskJS = function(){

	console.log('[ -------- Detección en JS -------- ]');
	
	return gulp.src(gulpFrontJSFiles) 
			   .pipe(replaceBatch(replacementsJS))
			   .pipe(concat('all.js'))
			   .pipe(gulp.dest('public/assets/js'));
};

gulp.task('watch', function(){
	
  console.log('[ -------- Comienzo Watch CSS y JS -------- ]');

  gulp.watch(gulpFrontCSSFiles, taskCSS); // Watch .css files
  gulp.watch(gulpFrontJSFiles, taskJS); // Watch .js files

});
