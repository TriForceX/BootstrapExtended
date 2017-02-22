/*JS Start*/

/* ================================================= DOCUMENT READY ================================================= */

//Cargar swipebox (lightbox)
swipeboxInit(0);

//******** DETECT HEIGHT CHANGE
function onElementHeightChange(elm, callback){
	var lastHeight = $(elm).height(), newHeight;
	(function run(){
		newHeight = $(elm).height();
		if( lastHeight != newHeight )
			callback();
		lastHeight = newHeight;

		if( elm.onElementHeightChangeTimer )
		  clearTimeout(elm.onElementHeightChangeTimer);

		elm.onElementHeightChangeTimer = setTimeout(run, 200);
	})();
}
//Sidebar
/*if($("CONTENT").length > 0)
{
	onElementHeightChange(".verticalAlign", function(){
		//console.log('la altura ha cambiado');
		//pageContResize();
		ResponsiveCode();
	});
}*/
//******** DETECT HEIGHT CHANGE

//Main URL
var mainUrl = $("body").attr("url");

//Es Home
if ($("#home").length > 0){
	var isHome = true;
}
else{
	var isHome = false;
}

//Es Movil
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent) ) //v2
{
	var isMovil = true;
}
else{
	var isMovil = false;
}

//OLD Internet Explorer Fixes
if($.browser.msie  && parseInt($.browser.version, 10) === 6 || 
   $.browser.msie  && parseInt($.browser.version, 10) === 7 || 
   $.browser.msie  && parseInt($.browser.version, 10) === 8 /*||  
   $.browser.msie  && parseInt($.browser.version, 10) === 9*/){
	var isOldIE = true;
}
else{
	var isOldIE = false;
}

if(isHome){
	//*** CODIGO SOLO EN HOME ***//

}
else
{
	//*** CODIGO FUERA DEL HOME ***//

}

if(isMovil){
	//*** CODIGO SOLO EN MOVIL ***//

}
else
{
	//*** CODIGO FUERA DEL HMOVIL ***//

}

if(isOldIE){
	//*** CODIGO SOLO EN OLD IEXPLORER ***//

}
else
{
	//*** CODIGO FUERA DE OLD IEXPLORER ***//

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
			//*** CODIGO GENERAL ORIENTACION ***//

		}

		$("body").attr("window-size",bodyWidth+" x "+bodyHeight);

		//*** CODIGO GENERAL RESPONSIVE ***//

		/*$("body").each(function(){ 

			var altoBody = bodyHeight;
			var altoCaja = $(".verticalAlign").find(".container").outerHeight(); 

			if(altoBody > altoCaja)
			{
				$(".verticalAlign").css({"margin-top": -Math.abs(altoCaja / 2),
										"position":"absolute",
										"top":"50%" });

			}
			else
			{
				$(".verticalAlign").css({"margin-top": "0px",
										"position":"relative",
										"top":"0px" });

			}
		});*/



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

//Form Validate
/*$(".class form").find("input[type='submit']").click(function(e){ 


	$(this).parent().each(function(){

		if( !( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) ) || 
			!( checkEmpty($("#field1").val()) )  
		){
			alert2("Formulario de contacto","Hubo un problema al enviar, por favor complete todos los campos");
			e.preventDefault();
		}
		else if( !(emailValido( $("#field1").val() )) )
		{
			alert2("Formulario de contacto","Hubo un problema al enviar, por favor ingrese un E-Mail válido");
			e.preventDefault();
		}
		else if( $.trim( $("#field1").val() ) == "" )
		{
			alert2("Formulario de contacto","Hubo un problema al enviar, por favor complete todos los campos");
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

//Text select on click
/*$(document).on("click", ".clickSelect", function(e) {
	$(this).select();
});*/

/* ================================================= DOCUMENT READY ================================================= */

/*JS End*/