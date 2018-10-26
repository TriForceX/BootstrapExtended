/* ================================================= EXAMPLE FUNCTIONS ================================================= */

//Example form validate custom function
function JSvalidateCustom(field)
{
	//Dev log
	JSconsole('[JS Example] Validate Custom');
	
	if(field === 'Custom')
	{
		return true;
	}
	else
	{
		return false;
	}
}

//Example Google Translate Widget styling function
function JSgoogleTranslateStyles()
{
	//Dev log
	JSconsole('[JS Example] Google Translate Styles');
	
	var css = '<style type="text/css" id="JSgoogleTranslateStyles">'+
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
	if(JSexist($('.goog-te-menu-frame').contents().find('body')))
	{
		if($('.goog-te-menu-frame').contents().find('#JSgoogleTranslateStyles').length < 1)
		{
			$('.goog-te-menu-frame').contents().find('body').prepend(css);
		}
	}
	else
	{
		setTimeout(JSgoogleTranslateStyles, 1000);
	}
}

/* ================================================= EXAMPLE FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= EXAMPLE DOCUMENT READY ================================================= */
	
	//Dev log
	JSconsole('[JS Example] Document Ready');
	
	//Set language on the fly
	if(JSgetUrlParameter('lang-test'))
	{
		JSmainLang = JSgetUrlParameter('lang-test');
	}
	
	//Example add language string
	JSlanguage['$test-hello'] = { 'en' : 'Hello world!', 'es' : 'Hola mundo!' };
	
	//Example use language string
	JSconsole(JSlang('$test-hello'));
	
	//Example lightGallery prev page
	$(document).on('onPrevPageChange.lg', function(event){
		window.location.href = $('.JSpagePrev').attr('href');
	});

	//Example lightGallery next page
	$(document).on('onNextPageChange.lg', function(event){
		window.location.href = $('.JSpageNext').attr('href'); 
	});
	
	//Example scroll to gallery page
	if(JSgetUrlParameter('page'))
	{
		JSautoScroll(".JSlightGalleryExample", true, 70);
	}
	
	//Example form validation
	$('.JSformExample').JSvalidateForm({
		noValidate: '#example-input-lastname',
		hasConfirm: true,
		customValidate: ['JSvalidateCustom', '#example-input-custom', 'Please fill the Custom Field.'],
		resetSubmit: true,
		errorStyling: true,
		modalSize: 'medium',
		modalAlign: 'top',
		modalAnimate: true,
	});
	
	//Example prevent title translation by Google
	$('title').addClass('notranslate');
	
	//Example test main url
	JSconsole('URL: '+JSmainUrl);
	
	//Example disable click on images
	JSdisabledClick('body img', 'Element disabled', 'You can not copy images from this site.');
	
	//Example aditional exceptions for disabled links
	JShashTagExceptions.push('#example');
	
	//Example aditional exceptions custom size & alignment
	JShashTagAlignment = ['small','center'];
	
	//Example aditional exceptions custom size & alignment
	JShashTagAnimate = true;
	
/* ================================================= EXAMPLE DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */
	
	//Dev log
	JSconsole('[JS Example] Window Load');
	
	//Example test progress bar on load
	$(".JSloadProgressTest .progress-bar").css("width", "100%");
	$(".JSloadProgressTest .progress-bar").attr("aria-valuenow","100");
	
	//Example Google Translate Widget styling
	if(JSexist($('#google_translate_element')))
	{
		JSgoogleTranslateStyles();
	}
	
/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */

});

$(document).on("JSresponsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */
	
	//Dev log
	JSconsole('[JS Example] Responsive Code');
	
	//Example size detection
	$("body").attr("window-size",bodyWidth+"x"+bodyHeight);
	
	//Example lower than tablet
	if(bodyWidth < bodyScreen.sm)
	{
		console.log('Tablet size and lower!');
	}
	
	//Example orientation
	if(bodyOrientation.landscape)
	{ 
		$("body").attr("window-orientation","landscape");
	}
	else
	{ 
		$("body").attr("window-orientation","portrait");
	}
	
/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */

});

$(document).ajaxStart(function(){

/* ================================================= EXAMPLE AJAX START ================================================= */
	
	//Dev log
	JSconsole('[JS Example] Ajax Start');
	
/* ================================================= EXAMPLE AJAX START ================================================= */

});

$(document).ajaxComplete(function() {

/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */
	
	//Dev log
	JSconsole('[JS Example] Ajax Complete');
	
/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */

});
