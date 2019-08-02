/* ================================================= EXAMPLE FUNCTIONS ================================================= */

// Example Plain HTML Gallery Parser
function JSparseHtmlGallery(page)
{
	JSdestroyLightGallery();
	
	if(page)
	{
		$('.JSlightGalleryMode').data('lg-page-current', page);
	}
	
	var gallery_group = 5;
	var gallery_elem = $('.JSlightGalleryMode .col-12');
	var gallery_page = parseInt($('.JSlightGalleryMode').data('lg-page-current'));
	var gallery_total = parseInt($('.JSlightGalleryMode').data('lg-page-total'));
	var gallery_prev = gallery_page <= 1 ? 1 : (gallery_page-1);
	var gallery_next = gallery_page >= gallery_total ? gallery_total : (gallery_page+1);
	var gallery_group_prev = gallery_page <= 1 ? 0 : ((gallery_group * gallery_page) - gallery_group);
	var gallery_group_next = gallery_page <= 1 ? gallery_group : (gallery_group * gallery_page);
	
	// Thumbs
	for(var num = 0; num < gallery_elem.length; num++)
	{
		if(num >= gallery_group_prev && num < gallery_group_next)
		{
			gallery_elem.eq(num).removeClass('d-none');
		}
		else
		{
			gallery_elem.eq(num).remove();
		}
	}
	
	// Pages
	if(!$.trim($('.pagination').eq(0).text()))
	{
		for(var num = 1; num <= gallery_total; num++)
		{
			var active = num == gallery_page ? 'active' : '';

			if(num == 1)
			{
				$('.pagination').eq(0).append('<li class="page-item"><a class="page-link prev" href="?page='+gallery_prev+'" class="prev"><span aria-hidden="true">&laquo;</span></a></li>');
			}

			$('.pagination').eq(0).append('<li class="page-item '+active+'"><a class="page-link" href="?page='+num+'">'+num+'</a></li>');

			if(num == gallery_total)
			{
				$('.pagination').eq(0).append('<li class="page-item"><a class="page-link next" href="?page='+gallery_next+'" class="next"><span aria-hidden="true">&raquo;</span></a></li>');
			}
		}
	}

	JSloadLightGallery();
}

// Example Google Translate Widget styling function
function JSgoogleTranslateStyles()
{
	// Console Log
	JSconsole('Example Google Translate Styles');
	
	var css = '<style type="text/css" id="JSgoogleTranslateStyles">'+
				'.goog-te-combo,'+
				'.goog-te-banner *,'+
				'.goog-te-ftab *,'+
				'.goog-te-menu *,'+
				'.goog-te-menu2 *,'+
				'.goog-te-balloon * {'+
				'	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;'+
				'	font-size: 12px !important;'+
				'}'+
				'.goog-te-menu-value span, '+
				'.goog-te-menu2-item span, '+
				'.goog-te-menu2-item-selected span{'+
				'	text-transform : capitalize !important;'+
				'}'+
				'</style>';
	
	// Menu iframe
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
	
	// Console Log
	JSconsole('Example Document Ready');
	
	// Example Get URL parameters
	var JSgetLanguage = JSgetUrlParameter('lang') ? JSgetUrlParameter('lang') : false;
	var JSgetGallery = JSgetUrlParameter('page') ? JSgetUrlParameter('page') : false;
	
	// Set language on the fly
	if(JSgetLanguage)
	{
		JSmainLang = JSgetLanguage;
	}
	
	// Example add language string
	JSlanguage['$test-hello'] = { 'en' : 'Hello world!', 'es' : 'Hola mundo!' };
	
	// Example use language string
	JSconsole(JSlang('$test-hello'));
	
	// Example lightGallery prev page
	$(document).on('onPrevPageChange.lg', function(event){
		window.location.href = $('.pagination .prev').attr('href');
	});

	// Example lightGallery next page
	$(document).on('onNextPageChange.lg', function(event){
		window.location.href = $('.pagination .next').attr('href'); 
	});
	
	// Example auto scroll to gallery page 2 & 3
	if(JSgetGallery)
	{
		JSautoScroll('.JSlightGalleryScroll', true, 70);
	}
	
	// Example Plain HTML Gallery Parser
	JSparseHtmlGallery(JSgetGallery);
	
	// Example form validation
	$('.JSformExample').JSvalidateForm({
		noValidate: '#example-input-lastname',
		hasConfirm: true,
		resetSubmit: true,
		errorStyling: true,
		errorScroll: true,
		errorModal: true,
		modalSize: 'medium',
		modalAlign: 'top',
		modalAnimate: true,
		customTitle: false,
		customValidate: function(result){
			// Custom function
			if($('#example-input-custom').val() != 'Custom') 
			{
				// Send error
				result = {'element'	: $('#example-input-custom'), 
						  'error'	: 'Please type "Custom" (without quotes).'};
			}
			// Return result
			return result;
		},
		customSubmit: function(){
			// Custom submit
			JSmodalAlert('Form Success!','The form passed sucessfully! Thanks!');
		},
	});
	
	// Example prevent title translation by Google
	$('title').addClass('notranslate');
	
	// Example test main url
	JSconsole('URL: '+JSmainUrl);
	
	// Example disable click on images
	JSdisabledClick('body img', 'Element disabled', 'You can not copy images from this site.');
	
	// Example aditional exceptions for disabled links
	JShashTagExceptions.push('#example');
	
	// Example aditional exceptions custom size & alignment
	JShashTagAlignment = ['small','center'];
	
	// Example aditional exceptions custom size & alignment
	JShashTagAnimate = true;
	
/* ================================================= EXAMPLE DOCUMENT READY ================================================= */

});

$(window).bind('load', function() {

/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */
	
	// Console Log
	JSconsole('Example Window Load');
	
	// Example test progress bar on load
	$(".JSloadProgressTest .progress-bar").css("width", "100%");
	$(".JSloadProgressTest .progress-bar").attr("aria-valuenow","100");
	
	// Example Google Translate Widget styling
	if(JSexist($('#google_translate_element')))
	{
		JSgoogleTranslateStyles();
	}
	
/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */

});

$(document).on('JSresponsiveCode', function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */
	
	// Console Log
	JSconsole('Example Responsive Code');
	
	// Example size detection
	$('body').attr('window-size',bodyWidth+'x'+bodyHeight);
	
	// Example lower than tablet
	if(bodyWidth < bodyScreen.sm.up)
	{
		JSconsole('Tablet size and lower!');
	}
	
	// Example orientation
	if(bodyOrientation.landscape)
	{ 
		$('body').attr('window-orientation','landscape');
	}
	else
	{ 
		$('body').attr('window-orientation','portrait');
	}
	
/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */

});

$(document).ajaxStart(function(){

/* ================================================= EXAMPLE AJAX START ================================================= */
	
	// Console Log
	JSconsole('Example Ajax Start');
	
/* ================================================= EXAMPLE AJAX START ================================================= */

});

$(document).ajaxComplete(function() {

/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */
	
	// Console Log
	JSconsole('Example Ajax Complete');
	
/* ================================================= EXAMPLE AJAX COMPLETE ================================================= */

});
