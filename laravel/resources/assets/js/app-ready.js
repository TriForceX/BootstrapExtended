$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */
	
	//Set language on the fly
	if(getUrlParameter('lang-test')=='es'){
		mainLang = 'es';
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

//Example form validate custom function
function validateCustom(field){
	if(field === 'Custom'){
		return true;
	}
	else{
		return false;
	}
}