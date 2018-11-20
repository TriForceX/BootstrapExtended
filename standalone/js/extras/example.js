/* ================================================= EXAMPLE FUNCTIONS ================================================= */

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
	
	// Example prevent title translation by Google
	$('title').addClass('notranslate');
	
/* ================================================= EXAMPLE DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */
	
	// Console Log
	JSconsole('Example Window Load');
	
	// Example Google Translate Widget styling
	if(JSexist($('#google_translate_element')))
	{
		JSgoogleTranslateStyles();
	}
	
/* ================================================= EXAMPLE WINDOWS LOAD ================================================= */

});

$(document).on("JSresponsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= EXAMPLE RESPONSIVE CODE ================================================= */
	
	// Console Log
	JSconsole('Example Responsive Code');
	
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
