/* ================================================= FUNCTIONS ================================================= */

//Global variables
var mainUrl = "@global-url";
var isHome;
var isMobile;
var isNavChrome;
var isNavIE;
var isNavIE6;
var isNavIE7;
var isNavIE8;
var isMozilla;
var isNavSafari;
var isNavOpera;
var isNavEdge;

//IE10 viewport hack for Surface/desktop Windows 8 bug
(function () {
  'use strict';

  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style');
    msViewportStyle.appendChild(
      document.createTextNode(
        '@-ms-viewport{width:auto!important}'
      )
    );
    document.querySelector('head').appendChild(msViewportStyle);
  }

})();

//Check attr function
$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};

//Check outer height with padding/margin
$.fn.outerHeight2 = function () {
	return this[0].getBoundingClientRect().height;
};

//Check outer width with padding/margin
$.fn.outerWidth2 = function () {
	return this[0].getBoundingClientRect().width;
};

//Form validate
$.fn.validateForm = function(options) {
	
	var settings = $.extend({
		noValidate: '',
		searchMode: false,
	}, options);
	
	$(this).submit(function(event){ 
		
		var formError = false;
		var formErrorTitle = '@validate-title';
		var formErrorText = [{'text': '@validate-text', 
							  'pass': '@validate-pass', 
							  'email': '@validate-email',
							  'search': '@validate-search',
							  'checkbox':'@validate-checkbox',
							  'textarea':'@validate-textarea',
							  'select':'@validate-select'}];

		//Select inputs
		$(this).find('select').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).find("option:selected").attr("value"))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['select'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});
		
		//Textarea inputs
		$(this).find('textarea').not(settings.noValidate).each(function(){
			if (!validateEmpty($.trim($(this).val()))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['textarea'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});

		//Checkbox inputs
		$(this).find('input[type="checkbox"]').not(settings.noValidate).each(function(){
			if (!$(this).is(':checked')) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['checkbox'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});
		
		//Search inputs
		$(this).find('input[type="search"]').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).val())) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['search'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});

		//Email inputs
		$(this).find('input[type="email"]').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).val()) || !validateEmail($(this).val())) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['email'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});

		//Text inputs (password)
		$(this).find('input[type="password"]').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).val())) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['pass'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});

		//Text inputs
		$(this).find('input[type="text"]').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).val())) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0]['text'];
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});

		//Send error
		if(formError != false){
			showAlert(formErrorTitle,formError);
			event.preventDefault();
		}
		//Check search mode
		if(settings.searchMode){
			var searchValue = $(this).find('input[type="search"]').val().replace(/ /g,'+');
			$(this).attr("action", $(this).attr("action")+searchValue);
		}
	});
};

//Form validate email
function validateEmail(field){
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
	if (!emailReg.test(field)){
        return false;
    }else{
        return true;
    }
}

//Form validate empty
function validateEmpty(field){
    if(field == "" ||
       field == null ||
       field == "undefinied"){
    	return false;
    }
    else if(/^\s*$/.test(field)){
        return false;
    }
    else{
        return true;
    }
}

//Convert string to boolean
function toBoolean(value) {
    var strValue = String(value).toLowerCase();
    strValue = ((!isNaN(strValue) && strValue !== '0') &&
        strValue !== '' &&
        strValue !== 'null' &&
        strValue !== 'undefined') ? '1' : strValue;
    return strValue === 'true' || strValue === '1' ? true : false
};

//Get max height from elements
function getMaxHeight(elems){
    return Math.max.apply(null, elems.map(function()
    {
        return $(this).outerHeight();
    }).get());
}

//Responsive Code
function responsiveCode() {
	var bodyWidth = document.body.clientWidth; //$(window).width();
	var bodyHeight = $(window).height();
	var bodyOrientation = bodyWidth > bodyHeight ? true : false;

	if (bodyWidth)
	{
		//'@screen-small-phone' => '320', 
		//'@screen-medium-phone' => '360',
		//'@screen-phone' => '480',
		//'@screen-tablet' => '768',
		//'@screen-desktop' => '992',  
		//'@screen-widescreen' => '1200', 
		//'@screen-full-hd' => '1920', 
		
		//*** RESPONSIVE CHANGES ***//

		//Example Vertical Align Container
		$("body").each(function(){

			var altoBody = bodyHeight;
			var altoCaja = $(".JSverticalAlign").outerHeight(); 

			if(altoBody > altoCaja)
			{
				$(".JSverticalAlign").css({"margin-top": -Math.abs(altoCaja / 2),
										 "position":"absolute",
										 "top":"50%",
										 "width":$(".JSverticalAlign").parent().width(),
										 "visibility":"visible"});
			}
			else
			{
				$(".JSverticalAlign").removeAttr("style");
			}
		});
		
		//Send data to event
		$(document).trigger("responsiveCode", [bodyWidth, bodyHeight, bodyOrientation]);
		
		//*** RESPONSIVE CHANGES ***//
	}else{
		window.setTimeout(ResponsiveCode, 30);
	}

}

$(window).bind("load", responsiveCode);
$(window).bind("resize", responsiveCode);
$(window).bind("orientationchange", responsiveCode);

//LightGallery destroy function
function destroyLightGallery(){
	$(".JSlightGallery").lightGallery().data('lightGallery').destroy(true);
}
//Lightgallery load function
function loadLightGallery(){
	
	$(".JSlightGallery").each(function(){ 

		var getMainUrl = mainUrl;
		var galSelectorVal = $(this).attr("lg-selector") == "auto" ? ".lg-contentphoto" : $(this).attr("lg-selector");
		var galThumbnailVal = $(this).attr("lg-thumbnail");
		var galDownloadVal = $(this).attr("lg-download");
		var galAutoTitle = $(this).attr("lg-autotitle");
		var galGalleryMode = $(this).attr("lg-gallerymode") == "true" ? $(this).addClass("lightGalleryMode") : '';
		var galPrevGalText = "Loading previous page ...";
		var galNextGalText = "Loading next page ...";
		var galLoadThumb = getMainUrl+"/plugins/lightgallery/img/lg-loading-icon.gif";
		var galPrevThumb = getMainUrl+"/plugins/lightgallery/img/lg-loading-prev.png";
		var galNextThumb = getMainUrl+"/plugins/lightgallery/img/lg-loading-next.png";
		
		if($(".JSlightGallery.lightGalleryMode .lg-prevthumb").length < 1 && $(".JSlightGallery.lightGalleryMode .lg-nextthumb").length < 1){
			$(".JSlightGallery.lightGalleryMode").prepend("<div class='lg-prevthumb' href='"+galLoadThumb+"' title='"+galPrevGalText+"'><img src='"+galPrevThumb+"'></div>");
			$(".JSlightGallery.lightGalleryMode").append("<div class='lg-nextthumb' href='"+galLoadThumb+"' title='"+galNextGalText+"'><img src='"+galNextThumb+"'></div>");
		}
		
		
		$(".JSlightGallery").find("img").each(function(){
			if($(this).parent().is("a") && !($(this).parent().hasAttr("target")) ){
				$(this).parent().addClass("lg-contentphoto");
			}
		});
		
		if(galAutoTitle!="false"){
			$(this).find(galSelectorVal).not(".lg-prevthumb, .lg-nextthumb").attr("title", galAutoTitle);
		}

		$(this).lightGallery({
			selector: galSelectorVal+", .lg-prevthumb, .lg-nextthumb", 
			thumbnail: toBoolean(galThumbnailVal),
			download: toBoolean(galDownloadVal),
			loop: false,
		}); 
		
		$(".JSlightGallery.lightGalleryMode").on('onAfterOpen.lg',function(event){
			//console.log("opened");
			$(".lg-outer .lg-thumb .lg-thumb-item:first-child").addClass("noBorder");
			$(".lg-outer .lg-thumb .lg-thumb-item:last-child").addClass("noBorder");
		});

		$(".JSlightGallery.lightGalleryMode").on('onAfterSlide.lg',function(event){
			var total = parseInt($("#lg-counter-all").html());
			var actual = parseInt($("#lg-counter-current").html());

			//console.log("slide");
			//console.log("total: "+total+" current: "+actual);

			if(actual == total){
				//console.log("closing... next page");
				$(".JSlightGallery").addClass("lightGalleryAuto");
				$(".JSlightGallery").addClass("lightGalleryAutoNext");
				setTimeout(function(){ 
					$(".lg-toolbar .lg-close").trigger("click");
				}, 1500);
			}
			if(actual == 1){
				//console.log("closing... prev page");
				$(".JSlightGallery").addClass("lightGalleryAuto");
				$(".JSlightGallery").addClass("lightGalleryAutoPrev");
				setTimeout(function(){ 
					$(".lg-toolbar .lg-close").trigger("click");
				}, 1500);
			}
		});

		$(".JSlightGallery.lightGalleryMode").on('onCloseAfter.lg',function(event){
			if($(this).hasClass("lightGalleryAuto")){
				if($(this).hasClass("lightGalleryAutoNext")){
					//Stuff to do on close
					$(document).trigger("onNextPageChange.lg"); ////Send data to event
				}
				else if($(this).hasClass("lightGalleryAutoPrev")){
					//Stuff to do on close
					$(document).trigger("onPrevPageChange.lg"); ////Send data to event
				}
				$(this).removeClass("lightGalleryAuto");
				$(this).removeClass("lightGalleryAutoPrev");
				$(this).removeClass("lightGalleryAutoNext");
			}
		});

	});
}

//ImageLiquid image function
function autoBackground(container){
	
	var bgData = new Array();
	var bgData = $(container).data("auto-bg").split(',');
	
	if (bgData[2] === undefined || bgData[2] === null)
	{
		bgData[2]="100%";
	}
	
	$(container).find("img").each(function(){
	
		$(this).css('width','auto');
		$(this).css('height','auto');
		$(this).css('min-width','inherit');
		$(this).css('min-height','inherit');
		$(this).addClass('FotosFix');
	
	});
	
	$(container).imgLiquid({ verticalAlign: bgData[0], horizontalAlign: bgData[1] });
	
	if(bgData[2].substr(bgData[2].length - 1, 1) == '%')
	{
		var bgSize = parseInt(bgData[2].replace(/\x25/g, '')); //%
		
		if(bgSize > 100 || bgSize < 100)
		{
			$(container).css("background-size",bgSize+"%");
		}
	}
	else
	{
		if(bgData[2]!="cover")
		{
			$(container).css("background-size",bgData[2]);
		}
	}
	
	$(container).find(".FotosFixInline").each(function(){ //.find("img").not(":first")
		
		$(this).removeClass("FotosFix");
		$(this).removeAttr("style");
	});
}

//Get element height changes
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
	
	//Example
	/*if($(".container").length > 0)
	{
		onElementHeightChange(".container", function(){
			console.log('Container height has changed');
			responsiveCode();
		});
	}*/
}

//Text cut function
function textCut(container){
	$(container).each(function(){
		$(this).html("<div><div>"+$(this).html()+"</div></div>");
	});
}

//Text auto size function (Note: Use this on responsive code to better results)
function textAutoSize(container, max){
	$(container).each(function (i,box){
		
		var width = $(box).width(),
			html = '<span style="white-space:nowrap"></span>',
			line = $(box).wrapInner(html).children()[0],
			n = max;

		$(box).css('font-size',n);

		while ($(line).width() > width) {
			$(box).css('font-size', --n);

		}

		$(box).text($(line).text());

		//Example
		//TextoFix(".container", 40); //Real Size in pixels

	});
}
//Show alert modal box using BootBox plugin
function showAlert(title,text,size){
	
	if(typeof size === 'undefined' || size === null){
		size = 'medium';
	}
	
	//Bootbox alert
	bootbox.alert({
		title: title,
        message: text,
        size: size,
		backdrop: true
    }).on("shown.bs.modal", function(){
		//Disable button auto-focus
		$(".modal .modal-footer .btn:focus").blur();
	});
	
	//Bootbox prompt
	/*bootbox.prompt({
		  title: "What is your real name?",
		  //value: "makeusabrew",
		  callback: function(result) {
				if (result === null) {
				  $('#alert').show("Prompt dismissed");
				} else {
				  $('#alert').show("Hi <b>"+result+"</b>");
				}
		  }
	});*/

	//Bootbox confirm
	/*bootbox.confirm({ 
		message: "¿Seguro que desea eliminar a este alumno?", 
		callback: function(result) {
			if (result == false) {
				$('#alert').show("Prompt dismissed");
			} else {
				$('#alert').show("Hi <b>"+result+"</b>");
			}
		}
	});*/
	
}

//YouTube get ID from URL
function youTubeParser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
	
	// http://www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index
	// http://www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/QdK8U-VIH_o
	// http://www.youtube.com/v/0zM3nApSvMg?fs=1&amp;hl=en_US&amp;rel=0
	// http://www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s
	// http://www.youtube.com/embed/0zM3nApSvMg?rel=0
	// http://www.youtube.com/watch?v=0zM3nApSvMg
	// http://youtu.be/0zM3nApSvMg
}
//Vimemo get ID from URL
function vimeoParser(url){
    var regExp = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
    var match = url.match(regExp);
    return match[5];
	
	// http://vimeo.com/*
	// http://vimeo.com/channels/*/*
	// http://vimeo.com/groups/*/videos/*
}

//Video launch modal box function
function videoLaunch(url, share, title){
	
	var ID;
	var embedUrl;
	var embedShare;
	var embedShareTitle = '@videolaunch-title';
	var embedShareText = '@videolaunch-text';
	
	if(typeof share === 'undefined' || share === null){
		share = false;
	}
	
	if(typeof title === 'undefined' || title === null){
		title = null;
	}
	
	if (url.indexOf('youtube') >= 0){
		ID = youTubeParser(url);
		embedUrl = 'https://www.youtube.com/embed/'+ID+'?rel=0';
		embedShare = 'https://youtu.be/'+ID;
	}
	else if (url.indexOf('vimeo') >= 0){
		ID = vimeoParser(url);
		embedUrl = 'https://player.vimeo.com/video/'+ID;
		embedShare = 'https://vimeo.com/'+ID;
	}
	else if (url.indexOf('facebook') >= 0){
		ID = '';
		embedUrl = 'https://www.facebook.com/plugins/video.php?href='+url+'&show_text=0';
		embedShare = url;
	}
	
	var content = '<iframe class="JSvideoLaunchIframe" src="'+embedUrl+'" frameborder="0" allowfullscreen></iframe>';
	
	if(share){
		content = content+'<div class="JSvideoLaunchURL">'+
							'	<b>'+embedShareTitle+' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></b>'+
							'	<input class="clickSelect" type="text" value="'+embedShare+'" readonly title="'+embedShareText+'" data-toggle="tooltip" data-placement="bottom">'+
							'</div>';
	}
	
	bootbox.alert({
		title: title,
        message: content,
        size: 'large',
		backdrop: true
    }).on("shown.bs.modal", function(){
		//Disable button auto-focus
		$(".modal .modal-footer .btn:focus").blur();
		//Modify facebook src
		if (url.indexOf('facebook') >= 0){
			var videoLaunchIframeSRC = $(".JSvideoLaunchIframe").attr("src");
			var videoLaunchIframeSRCwidth = $(".JSvideoLaunchIframe").width();
			var videoLaunchIframeSRCheight = $(".JSvideoLaunchIframe").height();
			$(".JSvideoLaunchIframe").attr("src",videoLaunchIframeSRC+"&width="+videoLaunchIframeSRCwidth+"&height="+videoLaunchIframeSRCheight);
		}
	});
	
	//Tooltip load
	$('*[data-toggle="tooltip"]').tooltip();
	
}

//Capitalize first function
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

//Convert to slug function
function convertToSlug(Text){
	return Text
	    .toLowerCase()
	    .replace(/[^\w ]+/g,'')
	    .replace(/ +/g,'-')
	    ;
}

//Auto scroll function
function autoScroll(selector,animated,distance){      
    var scrollDistance = distance;
    var scrollTarget = $(selector);

    if(animated=="yes"){
        $('html, body').animate({scrollTop: (scrollTarget.offset().top - scrollDistance)}, 500);
    }
    else{
        $('html, body').scrollTop(scrollTarget.offset().top - scrollDistance);
    }
}

//Disable right click menu
function disableClick(enable){
	if(enable){
		$("body").attr("oncontextmenu","return false");
	}
	else{
		$("body").removeAttr("oncontextmenu");
	}
}

//Get URL parameter from URL (PHP $_GET like)
function getUrlParameter(sParam){
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}
//Get URL parameter from Script SRC (PHP $_GET like)
function getSrcParameter(sParam){
	var scripts = document.getElementsByTagName('script');
	var index = scripts.length - 1;
	var myScript = scripts[index];
	// myScript now contains our script object
	var queryString = myScript.src.replace(/^[^\?]+\??/,'');

	var sPageURL = queryString,
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}

//Convert strings to links function
function linkify(inputText) {
    var replacedText, replacePattern1, replacePattern2, replacePattern3;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank" style="color:#385086; text-decoration: underline">$1</a>');

    //URLs starting with "www." (without // before it, or itd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank" style="color:#385086; text-decoration: underline">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
	//replacePattern3 = /(^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-\.]+?\.[a-zA-Z]{2,6}$)/gim;
	//replacePattern3 = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1" style="color:#385086; text-decoration: underline">$1</a>');

    return replacedText;
}

//Remove HTML tags function
function stripTags(container, items){
	container.find("*").not(items).each(function() {
		$(this).remove();
	});
}

//Check hasthag disabled links function
function checkDisabledLink(string){
	
	var textoUrl = string;

	//Sin Enlace
	if(textoUrl=="#no-link"){
		return false;
	}
	else if(textoUrl=="#"){
		return false;
	}
	else if(textoUrl=="#carousel-example-generic"){
		return true;
	}
	else if(textoUrl.indexOf('some-string') >= 0){
		//Stuff to do
		return false;
	}
	else{
		if(textoUrl.indexOf(window.location.host) <= 0){
			
			var seccion = capitalizeFirstLetter(textoUrl.split('#')[1]/*.replace("#", "")*/);
			//***
			if(textoUrl.substr(textoUrl.length - 1, 1) == 's') { //Spanish case for 2 or more
				showAlert(seccion+" disabled","This content is disabled or not available.");
			}
			else{
				showAlert(seccion+" disabled","This content is disabled or not available.");
			}
			
			return false;
		}
		else{
			return true;
		}
	}
}

//Window pop-up function
function windowPopup(url, width, height, alignX, alignY, scroll) {
	
    var leftPosition;
	var topPosition;
	var getScroll = scroll == true ? 'yes' : 'no';
	
	//Horizontal Align
	if(alignX=="right"){
		leftPosition = window.screen.width;
	}
	else if(alignX=="left"){
		leftPosition = 0;
	}
	else{
		leftPosition = (window.screen.width / 2) - ((width / 2) + 10);//Allow for borders.
	}

	//Vertical Align
	if(alignY=="top"){
		topPosition = 0;
	}
	else if(alignY=="bottom"){
		topPosition = window.screen.height;
	}
	else{
		topPosition = (window.screen.height / 2) - ((height / 2) + 50);//Allow for title and status bars.
	}
	
    //Open the window.
    window.open(url,"WindowPopupJS","status=no,"+
									"height="+height+","+
									"width="+width+","+
									"resizable=yes,"+
									"left="+leftPosition+","+
									"top="+topPosition+","+
									"screenX="+leftPosition+","+
									"screenY="+topPosition+","+
									"toolbar=no,"+
									"menubar=no,"+
									"scrollbars="+getScroll+","+
									"location=no,"+
									"directories=no");
}

/* ================================================= FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */

	//Load Responsive Code
	responsiveCode();

	//Load LightGallery
	loadLightGallery();

	//Is Home
	if ($(".isHome").length > 0){
		isHome = true;
	}
	else{
		isHome = false;
	}

	//Check mobile
	isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent);
	
	//Check navigators
	isNavChrome = $.browser.name == 'Chrome' && $.browser.webkit == true ? true : false;
	isNavIE = $.browser.name == 'Microsoft Internet Explorer' && $.browser.msie == true ? true : false;
	isNavIE6 = $.browser.name == 'Microsoft Internet Explorer' && $.browser.msie == true && $.browser.version == 6 ? true : false;
	isNavIE7 = $.browser.name == 'Microsoft Internet Explorer' && $.browser.msie == true && $.browser.version == 7 ? true : false;
	isNavIE8 =$.browser.name == 'Microsoft Internet Explorer' && $.browser.msie == true && $.browser.version == 8 ? true : false;
	isNavMozilla = $.browser.name == 'Firefox' && $.browser.mozilla == true ? true : false;
	isNavSafari = $.browser.name == 'Safari' && $.browser.webkit == true ? true : false;
	isNavOpera = $.browser.name == 'Opera' && $.browser.opera == true ? true : false;
	isNavEdge = $.browser.name == 'Microsoft Edge' ? true : false;
	
	/*var browserTest = ''		
					+'Chrome  = '+isNavChrome+'\n'		
					+'Microsoft Internet Explorer = '+isNavIE+'\n'		
					+'Microsoft Internet Explorer 6 = '+isNavIE6+'\n'		
					+'Microsoft Internet Explorer 7 = '+isNavIE7+'\n'		
					+'Microsoft Internet Explorer 8 = '+isNavIE8+'\n'		
 					+'Mozilla = '+isNavMozilla+'\n'		
					+'Safari = '+isNavSafari+'\n'			
					+'Opera = '+isNavOpera+'\n'		
 					+'Microsoft Edge = '+isNavEdge+'\n';		
	
	console.log(browserTest);*/

	//Tooltip load
	$('*[data-toggle="tooltip"]').tooltip();
	
	//Popover load
	$('*[data-toggle="popover"]').popover();

	//Carousel timer
	$('*[data-interval]').carousel({
		interval: $(this).data('interval');
	});
	
	//Apply Auto Background
	$("*[data-auto-bg]").each(function(){
		autoBackground($(this));
	});
	
	//Touch swipe bootstrap carousel
	$("*[data-ride='carousel']").swipe({
		swipe:function(event, direction, distance, duration, fingerCount, fingerData){
				if(direction == "right"){
					$(this).carousel('prev');  
				}
				else if(direction == "left"){
					$(this).carousel('next');  
				}
			}
	});
	
	//Apply Text Cur
	$(".JStextCut").each(function(){
		textCut($(this));
	});
	
	//Applu Data Tables
	$('.JSdataTables').each(function(){
		$(this).DataTable({
			paging: toBoolean($(this).data('pages')),
			searching: toBoolean($(this).data('filter')),
			info: toBoolean($(this).data('info')),
			ordering: toBoolean($(this).data('order')),
		});
	});
	
	//Text select on click
	$(document).on("click", ".JSclickSelect", function(e) {
		$(this).select();
	});
	
	//Modal on disabled links
	$(document).on("click", "a[href*=#]", function(e) {
		var source =  $(this).attr("href");

		if(!(checkDisabledLink(source))){
			e.preventDefault();
		}
	});
	
/* ================================================= DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= WINDOWS LOAD ================================================= */
	
	
	
/* ================================================= WINDOWS LOAD ================================================= */

});