/*JS Start*/

/* ================================================= DOCUMENT READY ================================================= */

//Load LightGallery
loadLightGallery();

//******** DETECT HEIGHT CHANGE

//Sidebar
/*if($("CONTENT").length > 0)
{
	onElementHeightChange(".verticalAlign", function(){
		//console.log('la altura ha cambiado');
		//pageContResize();
		ResponsiveCode();
	});
}*/

//Test height changes with click
/*$(".class").click(function(){
	$(".class").append("Sample text here...<br>");
});

$(".class").click(function(){
	$(".class").find("br:last").remove();
});*/
//Test height changes with click

//******** DETECT HEIGHT CHANGE

//Main URL
var mainUrl = $("body").attr("url");

//Is Home
if ($("#home").length > 0){
	var isHome = true;
}
else{
	var isHome = false;
}

//Is Mobile
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent) ) //v2
{
	var isMovil = true;
}
else{
	var isMovil = false;
}

//OLD Internet Explorer Fixes
if($.browser.msie && parseInt($.browser.version, 10) === 6 || 
   $.browser.msie && parseInt($.browser.version, 10) === 7 || 
   $.browser.msie && parseInt($.browser.version, 10) === 8 /*||  
   $.browser.msie && parseInt($.browser.version, 10) === 9*/){
	var isOldIE = true;
}
else{
	var isOldIE = false;
}

if(isHome){
	//*** IN HOME CODE ***//

}
else
{
	//*** NOT IN HOME CODE ***//

}

if(isMovil){
	//*** MOBILE CODE ***//

}
else{
	//*** NOT MOBILE CODE ***//

}

if(isOldIE){
	//*** OLD IEXPLORER CODE ***//

}
else
{
	//*** NOT OLD IEXPLORER CODE ***//

}

//FotoFix
$("*[fondo_pos]").each(function(){
	FotosFixV3($(this));
});

//Detectar navegadores
var isChrome = navigator.userAgent.indexOf('Chrome') > -1;
var isExplorer = navigator.userAgent.indexOf('MSIE') > -1;
var isFirefox = navigator.userAgent.indexOf('Firefox') > -1;
var isSafari = navigator.userAgent.indexOf("Safari") > -1;
var isOpera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
if ((isChrome)&&(isSafari)) {isSafari=false;}
if ((isChrome)&&(isOpera)) {isChrome=false;}


//***** SCROLLING CODE ******
var scrollStarted = 0;

$(window).scroll(function () {

	scrollStarted = 1;

});
//***** SCROLLING CODE ******

//Responsive
var screen_phone_sm = 320; 
var screen_phone_md = 360; 
var screen_phone_lg = 480; 
var screen_tablet = 768; 
var screen_desktop = 992; 
var screen_desktop_lg = 1024; 
var screen_widescreen = 1200; 
var screen_widescreen_lg = 1400; 

var screen_orientation = 0;
var screen_css = 14; //excedente para calzar con resize del css al mismo tiempo


//***** RESPONSIVE CODE ******
function ResponsiveCode() {
	var bodyWidth = document.body.clientWidth; //$(window).width();
	var bodyHeight = $(window).height();
	var bodyOrientation = null;

	if (bodyWidth)
	{
	//*********

		//Default
		$(window).bind( "orientationchange", function( event ) {
			screen_orientation = 0;
		});

		if(screen_orientation == 0)
		{
			screen_orientation = 1;
			//*** ORIENTATION CHANGES ***//
			
			//*** ORIENTATION CHANGES ***//
		}

		$("body").attr("window-size",bodyWidth+" x "+bodyHeight);

		//*** RESPONSIVE CHANGES ***//

		//Example Vertical Align Container
		$("body").each(function(){ 

			var altoBody = bodyHeight;
			var altoCaja = $(".verticalAlign").outerHeight(); 

			if(altoBody > altoCaja)
			{
				$(".verticalAlign").css({"margin-top": -Math.abs(altoCaja / 2),
										 "position":"absolute",
										 "top":"50%",
										 "width":$(".verticalAlign").parent().width(),
										 "visibility":"visible"});
			}
			else
			{
				$(".verticalAlign").removeAttr("style");
			}
		});
		//Example Vertical Align Container
		
		//*** RESPONSIVE CHANGES ***//


	 //*********
	}else{
		window.setTimeout(ResponsiveCode, 30);
	}

}
ResponsiveCode();

$(window).bind("load", ResponsiveCode);
$(window).bind("resize", ResponsiveCode);
$(window).bind("orientationchange", ResponsiveCode);
//***** RESPONSIVE CODE ******

var exampleLaunch = 0;
$(document).keyup(function(e){

	//Launch example page
	if(e.which == 69 && exampleLaunch == 0){ //E
		exampleLaunch = 1;
	}
	if(e.which == 88 && exampleLaunch == 1){ //X
		exampleLaunch = 2;
	}
	if(e.which == 65 && exampleLaunch == 2){ //A
		exampleLaunch = 3;
	}
	if(e.which == 77 && exampleLaunch == 3){ //M
		exampleLaunch = 4;
	}
	if(e.which == 80 && exampleLaunch == 4){ //P
		exampleLaunch = 5;
	}
	if(e.which == 76 && exampleLaunch == 5){ //L
		exampleLaunch = 6;
	}
	if(e.which == 69 && exampleLaunch == 6){ //E
		exampleLaunch = 7;
	}
	if(e.which == 13 && exampleLaunch == 7){ //Enter
		exampleLaunch = 8;
	}
	if(exampleLaunch == 8){
		exampleLaunch = 0;
		window.location = mainUrl+"/example.php";
	}
	//Launch example page
	
});

//Click Select Menu
/*$("select").change(function(e) {

	var itemURL =  $(this).find("option:selected").attr("value");

	if( $(this).find("option:selected").attr("value")!="seleccione" )
	{
		if(checkDisabledLink(itemURL)){
			window.location=itemURL;
		}
	
	}

});
//Click Select Menu*/

//Form Validate
/*$(".class form").find("input[type='submit']").click(function(e){ 


	$(this).parent().each(function(){

		if( !( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) )  
		){
			showAlert("Formulario de contacto","Hubo un problema al enviar, por favor complete todos los campos");
			e.preventDefault();
		}
		else if( !(emailValido( $("#field1").val() )) )
		{
			showAlert("Formulario de contacto","Hubo un problema al enviar, por favor ingrese un E-Mail válido");
			e.preventDefault();
		}
		else if( $.trim( $("#field1").val() ) == "" )
		{
			showAlert("Formulario de contacto","Hubo un problema al enviar, por favor complete todos los campos");
			e.preventDefault();
		}
		else
		{
			$(this).submit();
		}

	});

});*/
//Form Validate

//Touch swipe bootstrap carousel
/*$("#carousel-example-generic").swiperight(function() {  
	$(this).carousel('prev');  
});  
$("#carousel-example-generic").swipeleft(function() {  
	$(this).carousel('next');  
}); */

//Carousel timer
/*$('#carousel-example-generic').carousel({
    interval: 3000
});*/

//Text select on click
$(document).on("click", ".clickSelect", function(e) {
	$(this).select();
});

/* ================================================= DOCUMENT READY ================================================= */

/*JS End*/