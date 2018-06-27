/* ================================================= EXAMPLE FUNCTIONS ================================================= */

//Example form validate custom function
function validateCustom(field){
	if(field === 'Custom'){
		return true;
	}
	else{
		return false;
	}
}

//Example Google Translate Widget styling function
function googleTranslateStyles(){
	var style;
	var css = '<style type="text/css" id="googleTranslateStyles">'+
				'.goog-te-combo,'+
				'.goog-te-banner *,'+
				'.goog-te-ftab *,'+
				'.goog-te-menu *,'+
				'.goog-te-menu2 *,'+
				'.goog-te-balloon *{'+
				'	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;'+
				'	font-size: 12px !important;'+
				'}'+
				'.goog-te-menu-value span, '+
				'.goog-te-menu2-item span, '+
				'.goog-te-menu2-item-selected span{'+
				'	text-transform : capitalize !important;'+
				'}'+
				'</style>';
	
	//Menu iframe
	if((style = $('.goog-te-menu-frame').contents().find('body')).length){
		if($('.goog-te-menu-frame').contents().find('#googleTranslateStyles').length < 1){
			$('.goog-te-menu-frame').contents().find('body').prepend(css);
		}
	}
	else{
		setTimeout(googleTranslateStyles, 1000);
	}
}

/* ================================================= EXAMPLE FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= EXAMPLE DOCUMENT READY ================================================= */
	
	//Set language on the fly
	if(getUrlParameter('lang-test')){
		mainLang = getUrlParameter('lang-test');
	}
	
	//Example add language string
	language['@test-title'] = { 'en' : 'Hello world!', 'es' : 'Hola mundo!' };
	
	//Example use language string
	console.log(lang('@test-title'));
	
	//Example lightGallery prev page
	$(document).on('onPrevPageChange.lg', function(event){
		window.location.href = $('.JSpagePrev').attr('href');
	});

	//Example lightGallery next page
	$(document).on('onNextPageChange.lg', function(event){
		window.location.href = $('.JSpageNext').attr('href'); 
	});
	
	//Example scroll to gallery page
	if (getUrlParameter('page')){
		autoScroll(".JSlightGalleryExample",true,70);
	}
	
	//Example form validation
	$('.JSformExample').validateForm({
		noValidate: '#example-input-lastname',
		hasConfirm: true,
		customValidate: ['validateCustom', '#example-input-custom', 'Please fill the Custom Field.'],
		resetSubmit: true,
		errorStyling: true,
		modalSize: 'medium',
		modalAlign: 'top',
	});
	
	//Example prevent title translation by Google
	$('title').addClass('notranslate');
	
	//Example test URL
	console.log('URL: '+mainUrl);
	
	//Example aditional exceptions for disabled links
	checkDisabledExceptions.push('#example');
	
	//Example aditional exceptions custom size & alignment
	checkDisabledAlignment = ['small','center'];
	
/* ================================================= EXAMPLE DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */
	
	//Example test progress bar on load
	$(".JSloadProgressTest .progress-bar").css("width", "100%");
	$(".JSloadProgressTest .progress-bar").attr("aria-valuenow","100");
	
	//Example Google Translate Widget styling
	googleTranslateStyles();
	
/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */

});

$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */
	
	//Example size detection
	$("body").attr("window-size",bodyWidth+"x"+bodyHeight);
	
	//Example lower than tablet
	if (bodyWidth < bodyScreen.sm)
	{
		console.log('Tablet size and lower!');
	}
	
	//Example orientation
	if(bodyOrientation){ 
		$("body").attr("window-orientation","landscape");
	}
	else{ 
		$("body").attr("window-orientation","portrait");
	}
	
/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */

});

$(document).ajaxStart(function(){

/* ================================================= EXAMPLE AJAX START ================================================= */
	
	//Example console message
	console.log('Ajax Start...');
	
/* ================================================= EXAMPLE AJAX START ================================================= */

});

$(document).ajaxComplete(function() {

/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */
	
	//Example console message
	console.log('Ajax Complete!');
	
/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */

});
