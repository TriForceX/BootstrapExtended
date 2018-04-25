/* ================================================= FUNCTIONS ================================================= */

//Global variables
var mainUrl = '@global-url';
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
var checkDisabledExceptions = ['#carousel'];

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
$.fn.hasAttr = function(name)
{  
   return this.attr(name) !== undefined;
};

//Check outer height with padding/margin
$.fn.outerHeight2 = function()
{
	if(this[0] === undefined || this[0] === null || this[0] == ''){ //Empty value
		return null;
	}
	else{
		return this[0].getBoundingClientRect().height;
	}
};

//Check outer width with padding/margin
$.fn.outerWidth2 = function()
{
	if(this[0] === undefined || this[0] === null || this[0] == ''){ //Empty value
		return null;
	}
	else{
		return this[0].getBoundingClientRect().width;
	}
};

//Remove whitespaces between elements
$.fn.htmlClean = function()
{
    this.contents().filter(function() {
        if (this.nodeType !== 3) {
            $(this).htmlClean();
            return false;
        }
        else {
            this.textContent = $.trim(this.textContent);
            return !/\S/.test(this.nodeValue);
        }
    }).remove();
    return this;
};

//Form validate
$.fn.validateForm = function(options)
{	
	var settings = $.extend({
		noValidate		: '',
		hasConfirm		: false,
		customValidate	: null,
		resetSubmit		: true,
	}, options);
	
	$(this).submit(function(event){ 
		
		var formError = false;
		var formConfirmTitle = lang('@validate-confirm-title');
		var formConfirmText = lang('@validate-confirm-text');
		var formErrorTitle = lang('@validate-title');
		var formErrorText = {
							 'text': 		lang('@validate-normal'), 
							 'number': 		lang('@validate-number'), 
							 'tel': 		lang('@validate-tel'), 
							 'pass': 		lang('@validate-pass'), 
							 'email': 		lang('@validate-email'),
							 'search': 		lang('@validate-search'),
							 'checkbox':	lang('@validate-checkbox'),
							 'radio':		lang('@validate-radio'),
							 'textarea':	lang('@validate-textarea'),
							 'select':		lang('@validate-select'),
							};

		//Select inputs
		$(this).find('select').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).find("option:selected").attr("value"))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText.select;
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});
		
		//Textarea inputs
		$(this).find('textarea').not(settings.noValidate).each(function(){
			if (!validateEmpty($.trim($(this).val()))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText.textarea;
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});
		
		//Checkbox & radio group inputs
		$(this).find('[data-group]').each(function(){
			var type = $(this).data('group');
			var item = $(this).find("input[type='"+type+"']");
			var check = false;
		
			for (var i = item.length -1; i >= 0; i--){
				if(item.eq(i).is(":checked")){
					check = true;
				}
			}
			
			if(!check){
				item.addClass("JSvalidateErrorCheck");
				item.parent('label').addClass("JSvalidateError");
				formError = formErrorText[type];
			}
			else{
				item.removeClass("JSvalidateErrorCheck");
				item.parent('label').removeClass("JSvalidateError");
			}
		});
		
		//Input validation
		$(this).find('input').not(settings.noValidate).each(function(){
			switch($(this).attr("type")){
				case 'text':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.text;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'number':
					if (!validateEmpty($(this).val()) || !validateNumber($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.number;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'tel':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.tel;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'email':
					if (!validateEmpty($(this).val()) || !validateEmail($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.email;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'password':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.pass;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'search':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText.search;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				default:
					$(this).removeClass("JSvalidateError");
			}
		});
		
		//Custom validation
		if(settings.customValidate !== null){
			var CVFunction = settings.customValidate[0];
			var CVInput = settings.customValidate[1];
			var CVMessage = settings.customValidate[2];
			
			$(CVInput).each(function(){
				if (!window[CVFunction]($(this).val())) { 
					$(this).addClass("JSvalidateError");
					formError = CVMessage;
				}
				else{
					$(this).removeClass("JSvalidateError");
				}
			});
		}
		
		//Send error
		if(formError !== false){
			showAlert(formErrorTitle,formError,'medium');
			event.preventDefault();
		}
		
		//Check Confirm mode
		if(settings.hasConfirm && formError === false){
			var formElement = $(this);
			event.preventDefault();
			
			//Bootbox alert
			bootbox.confirm({
				title: formConfirmTitle,
				message: formConfirmText,
				size: 'medium',
				backdrop: true,
				callback: function(result){
					if(result){
						formElement.unbind("submit").submit();
						if(settings.resetSubmit){
							formElement.trigger('reset');
							formElement.find("input[type='checkbox']").prop('checked', false).parent().removeClass('active');
							formElement.find("input[type='radio']").prop('checked', false).parent().removeClass('active');
						}
						formElement.validateForm({
							noValidate: settings.noValidate,
							hasConfirm: settings.hasConfirm,
						});
					}
				}
			}).on("shown.bs.modal", function(){
				//Disable button auto-focus
				$(".modal .modal-footer .btn:focus").blur();
			});
		}
		
	});
};

//Form validate email
function validateEmail(field)
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
	if (!emailReg.test(field)){
        return false;
    }else{
        return true;
    }
}

//Form validate numbers
function validateNumber(field)
{
    var numberReg = /^-?\d+(\.\d+)?$/;
    
	if (!numberReg.test(field)){
        return false;
    }else{
        return true;
    }
}

//Form validate empty
function validateEmpty(field)
{
    if(field === undefined || field === null || field == '' || /^\s*$/.test(field)){
    	return false;
    }
    else{
        return true;
    }
}

//Convert string to boolean
function toBoolean(value)
{
    var strValue = String(value).toLowerCase();
    strValue = ((!isNaN(strValue) && strValue !== '0') &&
        strValue !== undefined &&
        strValue !== null &&
        strValue != '') ? '1' : strValue;
    return strValue === 'true' || strValue === '1' ? true : false;
}

//Get max height from elements
function getMaxHeight(elems, getrect)
{
    return Math.max.apply(null, elems.map(function()
    {
		if(getrect === true){
			return $(this).outerHeight2();
		}
		else{
			return $(this).outerHeight();
		}
    }).get());
}

//Responsive Code
function responsiveCode()
{
	var bodyWidth = document.body.clientWidth; //$(window).width();
	var bodyHeight = $(window).height();
	var bodyOrientation = bodyWidth > bodyHeight ? true : false;
	var bodyScreen = {'small-phone'		: '@screen-small-phone', //320
					  'medium-phone'	: '@screen-medium-phone', //360
					  'phone'			: '@screen-phone', //480
					  'tablet'			: '@screen-tablet', //768
					  'desktop'			: '@screen-desktop', //992
					  'widescreen'		: '@screen-widescreen', //1200
					  'full-hd'			: '@screen-full-hd'}; //1920

	if (bodyWidth)
	{
		//*** Responsive Changes ***//

		//Vertical Align Container
		$("body").each(function(){

			var valignBody = bodyHeight;
			var valignContainer = $(".JSverticalAlign").outerHeight(); 

			if(valignBody > valignContainer)
			{
				$(".JSverticalAlign").css({"margin-top": -Math.abs(valignContainer / 2),
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
		$(document).trigger("responsiveCode", [bodyWidth, bodyHeight, bodyOrientation, bodyScreen]);
		
		//*** Responsive Changes ***//
	}else{
		window.setTimeout(ResponsiveCode, 30);
	}

}

$(window).bind("load", responsiveCode);
$(window).bind("resize", responsiveCode);
$(window).bind("orientationchange", responsiveCode);

//LightGallery destroy function
function destroyLightGallery()
{
	$(".JSlightGallery").lightGallery().data('lightGallery').destroy(true);
}
//Lightgallery load function
function loadLightGallery()
{	
	$(".JSlightGallery").each(function(){ 

		var galSelectorVal = $(this).data("lg-item") === "auto" ? "a" : $(this).data("lg-item");
		var galThumbnailVal = $(this).data("lg-thumb");
		var galDownloadVal = $(this).data("lg-download");
		var galPrevGalText = lang('@lgtitle-prev');
		var galNextGalText = lang('@lgtitle-next');
		var galLoadThumb = mainUrl+"/resources/lightgallery/img/lg-loading-icon.gif";
		var galPrevThumb = mainUrl+"/resources/lightgallery/img/lg-loading-prev.png";
		var galNextThumb = mainUrl+"/resources/lightgallery/img/lg-loading-next.png";
		
		if(String($(this).data("lg-title")) != "false"){
			$(this).find(galSelectorVal).not(".lg-thumb-prev, .lg-thumb-next").attr("title", $(this).data("lg-title"));
		}
		
		if(toBoolean($(this).data("lg-gallery")) === true){
			$(this).addClass("JSlightGalleryMode");
		}
		
		if($(".lg-gallery-paginator").length > 0){
			if($(".JSlightGallery.JSlightGalleryMode .lg-thumb-prev").length < 1 && 
			   $(".JSlightGallery.JSlightGalleryMode .lg-thumb-next").length < 1){
				$(".JSlightGallery.JSlightGalleryMode").prepend("<div class='lg-thumb-prev' href='"+galLoadThumb+"' title='"+galPrevGalText+"'><img src='"+galPrevThumb+"'></div>");
				$(".JSlightGallery.JSlightGalleryMode").append("<div class='lg-thumb-next' href='"+galLoadThumb+"' title='"+galNextGalText+"'><img src='"+galNextThumb+"'></div>");
			}
		}
		
		$(this).lightGallery({
			selector: galSelectorVal+", .lg-thumb-prev, .lg-thumb-next", 
			thumbnail: toBoolean(galThumbnailVal),
			download: toBoolean(galDownloadVal),
			loop: false,
		}); 
		
		if($(".lg-gallery-paginator").length > 0){
			
			$(".JSlightGallery.JSlightGalleryMode").on('onAfterOpen.lg',function(){
				//console.log("opened");
				$(".lg-outer .lg-thumb .lg-thumb-item:first-child").addClass("JSlightGalleryNoBorder");
				$(".lg-outer .lg-thumb .lg-thumb-item:last-child").addClass("JSlightGalleryNoBorder");
			});

			$(".JSlightGallery.JSlightGalleryMode").on('onAfterSlide.lg',function(){
				var total = parseInt($("#lg-counter-all").html());
				var current = parseInt($("#lg-counter-current").html());

				if(current === total){
					//console.log("closing... next page");
					$(".JSlightGallery").addClass("lightGalleryAuto");
					$(".JSlightGallery").addClass("lightGalleryAutoNext");
					setTimeout(function(){ 
						$(".lg-toolbar .lg-close").trigger("click");
					}, 1500);
				}
				if(current === 1){
					//console.log("closing... prev page");
					$(".JSlightGallery").addClass("lightGalleryAuto");
					$(".JSlightGallery").addClass("lightGalleryAutoPrev");
					setTimeout(function(){ 
						$(".lg-toolbar .lg-close").trigger("click");
					}, 1500);
				}
			});

			$(".JSlightGallery.JSlightGalleryMode").on('onCloseAfter.lg',function(){
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
			
		}

	});
}

//ImgLiquid auto-fill background function
function imageFill(container)
{	
	var bgData = new Array();
	var bgVertical;
	var bgHorizontal;
	var bgFill;
	var bgFillSize;
	
	bgData = $(container).data('img-fill').split(',');
	
	//Check vertical align
	if(bgData[0] === undefined || bgData[0] === null || bgData[0] == ''){ //Empty value
		bgData[0] = 'center';
	}
	
	//Check horizontal align
	if(bgData[1] === undefined || bgData[1] === null || bgData[1] == ''){ //Empty value
		bgData[1] = 'center';
	}
	
	//Check fill
	if(bgData[2] === undefined || bgData[2] === null || bgData[2] == ''){ //Empty value
		bgData[2] = 'true';
	}
	
	//Set variables
	bgVertical = bgData[0];
	bgHorizontal = bgData[1];
	bgFill = bgData[2].indexOf('%') >= 0 || bgData[2].indexOf('px') >= 0 ||  bgData[2] === 'contain' ? false : true;
	bgFillSize = bgData[2].indexOf('%') >= 0 || bgData[2].indexOf('px') >= 0 ? parseInt(bgData[2].replace(/\x25|px/g, '')) : false;
	
	//Set changes
	$(container).imgLiquid({ 
		fill: bgFill,
		verticalAlign: bgVertical, 
		horizontalAlign: bgHorizontal,
	});
	
	//Set alternative fill
	if(bgFillSize)
	{
		if(bgFillSize > 100 || bgFillSize < 100)
		{
			$(container).css('background-size',bgData[2]);
		}
	}
}

//Get element height changes
function onElementHeightChange(elm, callback)
{
	var lastHeight = $(elm).height(), newHeight;
	(function run(){
		newHeight = $(elm).height();
		if(lastHeight !== newHeight){
			callback();
		}
		
		lastHeight = newHeight;

		if(elm.onElementHeightChangeTimer){
		  clearTimeout(elm.onElementHeightChangeTimer);
		}

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
function textCut(container)
{
	$(container).each(function(){
		$(this).html("<div><div>"+$(this).html()+"</div></div>");
	});
}

//Text auto size function (Note: Use this on responsive code to better results)
function textSize(container, fontsize)
{
	$(container).each(function (i,box){
		
		var width = $(box).width(),
			html = '<span style="white-space:nowrap"></span>',
			line = $(box).wrapInner(html).children()[0],
			n = fontsize.replace(/px/g,'');

		$(box).css('font-size',n);

		while ($(line).width() > width) {
			$(box).css('font-size', --n);
		}

		$(box).text($(line).text());
	});
}

//Show alert modal box using BootBox plugin
function showAlert(title, text, size)
{
	if(size === undefined || size === null || size == ''){  //Empty value
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
}

//Show alert modal box using BootBox plugin (Content)
function showContent(title, element, size)
{
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	//Bootbox alert
	bootbox.alert({
		title: title,
        message: $(element).html(),
        size: size,
		backdrop: true
    }).on("shown.bs.modal", function(){
		//Disable button auto-focus
		$(".modal .modal-footer .btn:focus").blur();
	});
}

//Show alert modal box using BootBox plugin (Ajax)
function showAjax(title, fullurl, size, loading, debug)
{
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	if(loading === undefined || loading === null || loading == ''){  //Empty value
		loading = false;
	}
	
	if(debug === undefined || debug === null || debug == ''){  //Empty value
		debug = false;
	}
	
	$.ajax({
		url: fullurl,
		type: 'GET', 
		dataType: 'html',
		beforeSend: function(){
			//Loading
			if(debug){
				console.log("showAjax Loading ...");
			}
			//Show loading colored icon
			if(loading){
				$("body").append("<div class='JSloading "+loading+"'></div>");
			}
		},
		success: function(data){  
			//Loaded
			if(debug){
				console.log("showAjax Loaded!");
			}
			//Show content
			showAlert(title,data,size);
			//Remove loading icon
			if(loading){
				$(".JSloading").remove();
			}
		},
		error: function(xhr, status, error){
			//Error
			if(debug){
				console.log("showAjax Error! ("+xhr.status+")");
				
				if(!(xhr.responseText === undefined || xhr.responseText === null || xhr.responseText == '')){
					console.log("---------------\n"+xhr.responseText);
				}
			}
			//Remove loading icon
			if(loading){
				$(".JSloading").remove();
			}
		}
	});
}

//YouTube get ID from URL
function youTubeParser(url)
{
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
function vimeoParser(url)
{
    var regExp = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
    var match = url.match(regExp);
    return match[5];
	
	// http://vimeo.com/*
	// http://vimeo.com/channels/*/*
	// http://vimeo.com/groups/*/videos/*
}

//Video launch modal box function
function videoLaunch(url, share, title, autoplay)
{	
	if(share === undefined || share === null || share == ''){  //Empty value
		share = false;
	}
	
	if(title === undefined || title === null || title == ''){  //Empty value
		title = '';
	}
	
	if(autoplay === undefined || autoplay === null || autoplay == ''){  //Empty value
		autoplay = false;
	}
	
	var ID;
	var embedUrl;
	var embedShare;
	var embedShareTitle = lang('@videolaunch-title');
	var embedShareText = lang('@videolaunch-text');
	var embedAutoPlay = '';
	
	if (url.indexOf('youtube') >= 0){
		ID = youTubeParser(url);
		if(autoplay){
			embedAutoPlay = '&autoplay=1';
		}
		embedUrl = 'https://www.youtube.com/embed/'+ID+'?rel=0'+embedAutoPlay;
		embedShare = 'https://youtu.be/'+ID;
	}
	else if (url.indexOf('vimeo') >= 0){
		ID = vimeoParser(url);
		if(autoplay){
			embedAutoPlay = '?autoplay=1';
		}
		embedUrl = 'https://player.vimeo.com/video/'+ID+''+embedAutoPlay;
		embedShare = 'https://vimeo.com/'+ID;
	}
	else if (url.indexOf('facebook') >= 0){
		ID = '';
		if(autoplay){
			embedAutoPlay = '&autoplay=1';
		}
		embedUrl = 'https://www.facebook.com/plugins/video.php?href='+url+'&show_text=0'+embedAutoPlay;
		embedShare = url;
	}
	else { //Only ID will take YouTube as default
		ID = url;
		if(autoplay){
			embedAutoPlay = '&autoplay=1';
		}
		embedUrl = 'https://www.youtube.com/embed/'+ID+'?rel=0'+embedAutoPlay;
		embedShare = 'https://youtu.be/'+ID;
	}
	
	var content = '<div class="JSvideoLaunchIframe embed-responsive embed-responsive-16by9">'+
			  		'	<iframe class="embed-responsive-item" src="'+embedUrl+'" frameborder="0" allowfullscreen></iframe>'+
			  		'</div>';
	
	if(share){
		content = content+'<a class="JSvideoLaunchURL" data-clipboard-action="copy" data-clipboard-target=".JSvideoLaunchCopy">'+
							'	<div class="JSvideoLaunchButton">'+embedShareTitle+' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>'+
							'	<div class="JSvideoLaunchText">'+embedShare+'</div>'+
							'	<div class="JSvideoLaunchCopy">'+embedShare+'</div>'+
							'</a>';
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
			var videoLaunchIframeSRC = $(".JSvideoLaunchIframe iframe").attr("src");
			var videoLaunchIframeSRCwidth = $(".JSvideoLaunchIframe iframe").width();
			var videoLaunchIframeSRCheight = $(".JSvideoLaunchIframe iframe").height();
			$(".JSvideoLaunchIframe iframe").attr("src",videoLaunchIframeSRC+"&width="+videoLaunchIframeSRCwidth+"&height="+videoLaunchIframeSRCheight);
		}
	});

	//Tooltip load
	$('.JSvideoLaunchText').tooltip({
		title: embedShareText,
		placement: 'bottom',
		trigger: 'manual',
	});

	//Clipboard
	var clipboard = new Clipboard('.JSvideoLaunchURL');

	clipboard.on('success', function(){
		$('.JSvideoLaunchText').tooltip('show');
	});

	clipboard.on('error', function(){
		$('.JSvideoLaunchURL').attr('target','blank');
		$('.JSvideoLaunchURL').attr('href',embedShare);
	});
}

//Capitalize first function
function capitalizeFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

//Convert to slug function
function convertToSlug(Text)
{
	return Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

//Auto scroll function
function autoScroll(selector,animated,distance)
{      
    var scrollDistance = distance;
    var scrollTarget = $(selector);
	var scrollAnimated = animated == true ? 500 : animated;

    if(scrollAnimated){
        $('html, body').animate({scrollTop: (scrollTarget.offset().top - scrollDistance)}, scrollAnimated);
    }
    else{
        $('html, body').scrollTop(scrollTarget.offset().top - scrollDistance);
    }
}

//Disable right click menu
function disableClick(enable)
{
	if(enable){
		$("body").attr("oncontextmenu","return false");
	}
	else{
		$("body").removeAttr("oncontextmenu");
	}
}

//Get URL parameter from URL (PHP $_GET like)
function getUrlParameter(sParam)
{
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
function getSrcParameter(sParam)
{
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
function linkify(inputText)
{
    var replacedText, replacePattern1, replacePattern2, replacePattern3;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or itd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    return replacedText;
}

//Remove HTML tags function
function stripTags(container, items)
{
	container.find("*").not(items).each(function() {
		$(this).remove();
	});
}

//Check hasthag disabled links function
function checkDisabledLink(string)
{	
	var textUrl = string;
	var exceptions = checkDisabledExceptions;
	
	//Exception 1
	for (var i = exceptions.length - 1; i >= 0; --i){
		if (textUrl.indexOf(exceptions[i]) != -1){
			return true;
		}
	}

	//Exception 2
	if(textUrl==="#"){
		return false;
	}
	else{
		if(textUrl.indexOf(window.location.host) <= 0){
			//Show alert
			var section = textUrl.split('#')[1].replace(/-/g,' ');
			showAlert(section,lang('@disabled-text'));
			return false;
		}
		else{
			return true;
		}
	}
}

//Window pop-up function
function windowPopup(element, errortitle, errormsg)
{	
	if(errortitle === undefined || errortitle === null || errortitle == ''){  //Empty value
		errortitle = lang('@winpopup-title');
	}
	
	if(errormsg === undefined || errormsg === null || errormsg == ''){  //Empty value
		errormsg = lang('@winpopup-text');
	}
	
    var leftPosition;
	var topPosition;
	var getUrl = $(element).data('win-url');
	var getSize = $(element).data('win-size').split('x');
	var getAlign = $(element).data('win-align').split(',');
	var getScroll = $(element).data('win-scroll');
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent);
	
	//Horizontal Align
	if(getAlign[0]==="right"){
		leftPosition = window.screen.width;
	}
	else if(getAlign[0]==="left"){
		leftPosition = 0;
	}
	else{
		leftPosition = (window.screen.width / 2) - ((getSize[0] / 2) + 10);//Allow for borders.
	}

	//Vertical Align
	if(getAlign[1]==="top"){
		topPosition = 0;
	}
	else if(getAlign[1]==="bottom"){
		topPosition = window.screen.height;
	}
	else{
		topPosition = (window.screen.height / 2) - ((getSize[1] / 2) + 50);//Allow for title and status bars.
	}
	
    //Open the window.
	var newWin = window.open(getUrl,"WindowPopupJS","status=no,"+
									"width="+getSize[0]+","+
									"height="+getSize[1]+","+
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
	if(!newWin || newWin.closed || typeof newWin.closed == 'undefined') 
	{ 
		showAlert(errortitle, errormsg, 'small');
	}
}

//Map launch function
function mapLaunch(element)
{	
	var mapContent;
	var mapTitle = lang('@maplaunch-title');
	var mapText = lang('@maplaunch-text');
	var mapIcon1 = mainUrl+"/css/icons/maplaunch/google-maps.png";
	var mapIcon2 = mainUrl+"/css/icons/maplaunch/waze.png";
	var mapCoords1 = $(element).data('map-coords-1').split(',');
	var mapCoords2 = $(element).data('map-coords-2').split(',');
	var mapAddress = $(element).data('map-address');
	var mapAddressUrl = encodeURI(mapAddress).replace(/%20/g,'+');
	var mapLaunchUrl1 = isMobile ? 'http://maps.google.com/maps?q='+mapCoords1[0]+','+mapCoords1[1]+','+mapCoords1[2]+'z' : 
										   'https://www.google.cl/maps/search/'+mapAddressUrl+'/@'+mapCoords1[0]+','+mapCoords1[1]+','+mapCoords1[2]+'z';
	var mapLaunchUrl2 = isMobile ? 'waze://?ll='+mapCoords2[0]+','+mapCoords2[1]+'&navigate=yes' : 
										   'https://www.waze.com/livemap?zoom='+mapCoords2[2]+'&lat='+mapCoords2[0]+'&lon='+mapCoords2[1];
	
	mapContent = '<div class="JSmapLaunchInfo">'+
				'	<span class="label label-primary">'+mapText+'</span>'+
				'	<div class="JSmapLaunchIcons">'+
				'		<a href="'+mapLaunchUrl1+'" target="_blank">'+
				'			<img src="'+mapIcon1+'">'+
				'		</a>'+
				'		<a href="'+mapLaunchUrl2+'" target="_blank">'+
				'			<img src="'+mapIcon2+'">'+
				'		</a>'+
				'	</div>'+
				'	<div class="well">'+mapAddress+'</div>'+
				'</div>';
	
	showAlert(mapTitle, mapContent, 'small');
}

//Paginator group
function paginatorGroup(limit,limitMobile,exceptions)
{
	if(exceptions === undefined || exceptions === null || exceptions == ''){  //Empty value
		exceptions = '';
	}
	
	$(".JSpaginator .JSpageItems").each(function(){ 

		var items = $(this).find("a").not(exceptions);
		var amount = ((isMobile) ? limitMobile : limit);
		for(var i = 0; i < items.length; i+=amount)
		{
			if(items.slice(i, i+amount).hasClass("JSpageActive")){
				items.slice(i, i+amount).wrapAll("<div class='JSpageGroup JSpageActive'></div>");
			}
			else{
				items.slice(i, i+amount).wrapAll("<div class='JSpageGroup'></div>");
			}
		}

		$(".JSpaginator .JSpageItems .JSpageGroup.JSpageActive").prev().addClass("JSpageGroupPrev");
		$(".JSpaginator .JSpageItems .JSpageGroup.JSpageActive").next().addClass("JSpageGroupNext");
	});
}

//Main Initialization
function mainInit()
{
	//Load LightGallery
	loadLightGallery();
	
	//Tooltip load
	$('*[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
	
	//Popover load
	$('*[data-toggle="popover"]').popover();
	
	//Touch swipe bootstrap carousel
	$('*[data-ride="carousel"]').swipe({
		swipe:function(event, direction, distance, duration, fingerCount, fingerData){
				if(direction === 'right'){
					$(this).carousel('prev');  
				}
				else if(direction === 'left'){
					$(this).carousel('next');  
				}
			},
		allowPageScroll:'vertical',
	});
	
	//Applu Data Tables
	$('.JSdataTables').each(function(){
		
		$(this).dataTable().fnDestroy();
		$(this).DataTable({
			paging: toBoolean($(this).data('table-pages')),
			searching: toBoolean($(this).data('table-search')),
			info: toBoolean($(this).data('table-info')),
			ordering: toBoolean($(this).data('table-sort')),
        });
	});
	
	//Apply Image Fill
	$('.JSimgFill').each(function(){
		imageFill($(this));
	});
	
	//Apply Text Cur
	$(".JStextCut").each(function(){
		textCut($(this));
	});
	
	//Apply Rotation
	$(".JSrotate").each(function(){
		$(this).rotate({
			angle: $(this).data('rotate-angle')
		});
		$(this).css('visibility','visible');
	});
}
/* ================================================= FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */
	
	//Check home
	isHome = $('.JSisHome').length > 0 ? true : false;

	//Check mobile
	isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent);
	
	//Check navigators
	isNavChrome = $.browser.name === 'Chrome' && $.browser.webkit === true ? true : false;
	isNavIE = $.browser.name === 'Microsoft Internet Explorer' && $.browser.msie === true ? true : false;
	isNavIE6 = $.browser.name === 'Microsoft Internet Explorer' && $.browser.msie === true && $.browser.version === 6 ? true : false;
	isNavIE7 = $.browser.name === 'Microsoft Internet Explorer' && $.browser.msie === true && $.browser.version === 7 ? true : false;
	isNavIE8 =$.browser.name === 'Microsoft Internet Explorer' && $.browser.msie === true && $.browser.version === 8 ? true : false;
	isNavMozilla = $.browser.name === 'Firefox' && $.browser.mozilla === true ? true : false;
	isNavSafari = $.browser.name === 'Safari' && $.browser.webkit === true ? true : false;
	isNavOpera = $.browser.name === 'Opera' && $.browser.opera === true ? true : false;
	isNavEdge = $.browser.name === 'Microsoft Edge' ? true : false;
	
	//Map Launch on click
	$(document).on("click", ".JSwindowPopup", function(){
		windowPopup($(this));
	});
	
	//Map Launch on click
	$(document).on("click", ".JSmapLaunch", function(){
		mapLaunch($(this));
	});
	
	//Modal on disabled links
	$(document).on("click", "a[href*=#]", function(e){
		var source =  $(this).attr("href");
		if(!(checkDisabledLink(source))){
			e.preventDefault();
		}
	});
	
	//Load Responsive Code
	responsiveCode();
	
	//Launch main functions
	mainInit();
	
/* ================================================= DOCUMENT READY ================================================= */

});

$(window).bind("load", function() {

/* ================================================= WINDOWS LOAD ================================================= */
	
	
	
/* ================================================= WINDOWS LOAD ================================================= */

});

$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= RESPONSIVE CODE ================================================= */
	
	//Apply Text Size
	$(".JStextSize").each(function(){
		$(this).removeAttr('style');
		textSize($(this), $(this).css('font-size'));
	});
	
/* ================================================= RESPONSIVE CODE ================================================= */

});

$(document).ajaxComplete(function() {

/* ================================================= AJAX COMPLETE ================================================= */
	
	mainInit();
	
/* ================================================= AJAX COMPLETE ================================================= */

});