//Example form validate custom function
function validateCustom(field){
	if(field === 'Custom'){
		return true;
	}
	else{
		return false;
	}
}

$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */
	
	//Set language on the fly
	if(getUrlParameter('lang-test')){
		mainLang = getUrlParameter('lang-test');
	}
	
	//Example add language string
	language['@test-title'] = { 'en' : 'Hello world!', 'es' : 'Hola mundo!' };
	
	//Example use language string
	console.log(lang('@test-title'));

	//Example lightGallery next page
	$(document).on('onNextPageChange.lg', function(event){
		window.location.href = $('.lg-next').attr('href'); 
	});
	
	//Example lightGallery prev page
	$(document).on('onPrevPageChange.lg', function(event){
		window.location.href = $('.lg-prev').attr('href');
	});
	
	//Example scroll to gallery page
	if (getUrlParameter('page')){
		autoScroll(".JSlightGallery",true,0);
	}
	
	//Example form validation
	$('.JSformExample').validateForm({
		noValidate: '#example-input-lastname',
		hasConfirm: true,
		customValidate: ['validateCustom', '#example-input-custom', 'Custom error alert message.'],
		resetSubmit: true,
	});
	
	//Example test URL
	console.log('URL: '+mainUrl);
	
	//Example aditional exceptions for disabled links
	checkDisabledExceptions.push('#example');
	
/* ================================================= DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= WINDOWS LOAD ================================================= */
	
	//Example test progress bar on load
	$(".JSloadProgressTest .progress-bar").css("width", "100%");
	$(".JSloadProgressTest .progress-bar").attr("aria-valuenow","100");
	
/* ================================================= WINDOWS LOAD ================================================= */

});

$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= RESPONSIVE CODE ================================================= */
	
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
	
/* ================================================= RESPONSIVE CODE ================================================= */

});

$(document).ajaxComplete(function() {

/* ================================================= AJAX COMPLETE ================================================= */
	
	console.log('Ajax Complete!');
	
/* ================================================= AJAX COMPLETE ================================================= */

});