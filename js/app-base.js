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
		hasConfirm: false,
	}, options);
	
	$(this).submit(function(event){ 
		
		var formError = false;
		var formConfirmTitle = '@validate-confirm-title';
		var formConfirmText = '@validate-confirm-text';
		var formErrorTitle = '@validate-title';
		var formErrorText = [{'text': '@validate-normal', 
							  'number': '@validate-number', 
							  'pass': '@validate-pass', 
							  'email': '@validate-email',
							  'search': '@validate-search',
							  'checkbox':'@validate-checkbox',
							  'radio':'@validate-radio',
							  'textarea':'@validate-textarea',
							  'select':'@validate-select'}];

		//Select inputs
		$(this).find('select').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).find("option:selected").attr("value"))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0].select;
			}
			else{
				$(this).removeClass("JSvalidateError");
			}
		});
		
		//Textarea inputs
		$(this).find('textarea').not(settings.noValidate).each(function(){
			if (!validateEmpty($.trim($(this).val()))) { 
				$(this).addClass("JSvalidateError");
				formError = formErrorText[0].textarea;
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
				formError = formErrorText[0][type];
			}
			else{
				item.removeClass("JSvalidateErrorCheck");
				item.parent('label').removeClass("JSvalidateError");
			}
		});
		
		//Input tags
		$(this).find('input').not(settings.noValidate).each(function(){
			switch($(this).attr("type")){
				case 'text':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText[0].text;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'number':
					if (!validateEmpty($(this).val()) || !validateNumber($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText[0].number;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'email':
					if (!validateEmpty($(this).val()) || !validateEmail($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText[0].email;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'password':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText[0].pass;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				case 'search':
					if (!validateEmpty($(this).val())) { 
						$(this).addClass("JSvalidateError");
						formError = formErrorText[0].search;
					}
					else{
						$(this).removeClass("JSvalidateError");
					}
					break;
				default:
					$(this).removeClass("JSvalidateError");
			}
		});

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
						formElement.trigger('reset');
						formElement.find("input[type='checkbox']").prop('checked', false).parent().removeClass('active');
						formElement.find("input[type='radio']").prop('checked', false).parent().removeClass('active');
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
function validateEmail(field){
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
	if (!emailReg.test(field)){
        return false;
    }else{
        return true;
    }
}

//Form validate numbers
function validateNumber(field){
    var numberReg = /^-?\d+(\.\d+)?$/;
    
	if (!numberReg.test(field)){
        return false;
    }else{
        return true;
    }
}

//Form validate empty
function validateEmpty(field){
    if(field === "" ||
       field === null ||
       field === undefined){
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
    return strValue === 'true' || strValue === '1' ? true : false;
}

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

		var galSelectorVal = $(this).data("lg-item") === "auto" ? ".JSlightGallerySelector" : $(this).data("lg-item");
		var galThumbnailVal = $(this).data("lg-thumb");
		var galDownloadVal = $(this).data("lg-download");
		var galPrevGalText = "Loading previous page ...";
		var galNextGalText = "Loading next page ...";
		var galLoadThumb = mainUrl+"/plugins/lightgallery/img/lg-loading-icon.gif";
		var galPrevThumb = mainUrl+"/plugins/lightgallery/img/lg-loading-prev.png";
		var galNextThumb = mainUrl+"/plugins/lightgallery/img/lg-loading-next.png";
		
		if(toBoolean($(this).data("lg-title")) === false){
			$(this).find(galSelectorVal).not(".lg-thumb-prev, .lg-thumb-next").attr("title", $(this).data("lg-title"));
		}
		
		if(toBoolean($(this).data("lg-gallery")) === true){
			$(this).addClass("JSlightGalleryMode");
		}
		
		if($(".JSlightGallery.JSlightGalleryMode .lg-thumb-prev").length < 1 && $(".JSlightGallery.JSlightGalleryMode .lg-thumb-next").length < 1){
			$(".JSlightGallery.JSlightGalleryMode").prepend("<div class='lg-thumb-prev' href='"+galLoadThumb+"' title='"+galPrevGalText+"'><img src='"+galPrevThumb+"'></div>");
			$(".JSlightGallery.JSlightGalleryMode").append("<div class='lg-thumb-next' href='"+galLoadThumb+"' title='"+galNextGalText+"'><img src='"+galNextThumb+"'></div>");
		}
		
		$(".JSlightGallery").find("img").each(function(){
			if($(this).parent().is("a") && !($(this).parent().hasAttr("target")) ){
				$(this).parent().addClass("JSlightGallerySelector");
			}
		});
		
		$(this).lightGallery({
			selector: galSelectorVal+", .lg-thumb-prev, .lg-thumb-next", 
			thumbnail: toBoolean(galThumbnailVal),
			download: toBoolean(galDownloadVal),
			loop: false,
		}); 
		
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

	});
}

//ImgLiquid auto-fill background function
function autoBackground(container){
	
	var bgData = new Array();
	bgData = $(container).data("auto-bg").split(',');
	
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
	
	if(bgData[2].substr(bgData[2].length - 1, 1) === '%')
	{
		var bgSize = parseInt(bgData[2].replace(/\x25/g, '')); //%
		
		if(bgSize > 100 || bgSize < 100)
		{
			$(container).css("background-size",bgSize+"%");
		}
	}
	else
	{
		if(bgData[2]!=="cover")
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
	if(typeof size === undefined || size === null){
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
	
	if(typeof share === undefined || share === null){
		share = false;
	}
	
	if(typeof title === undefined || title === null){
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

    clipboard.on('success', function() {
		$('.JSvideoLaunchText').tooltip('show');
    });
	
	clipboard.on('error', function() {
		$(document).on("click", ".JSvideoLaunchURL", function(){
			 window.open(embedShare, '_blank');
		});
    });
}

//Capitalize first function
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

//Convert to slug function
function convertToSlug(Text){
	return Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

//Auto scroll function
function autoScroll(selector,animated,distance){      
    var scrollDistance = distance;
    var scrollTarget = $(selector);

    if(animated){
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
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or itd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
	//replacePattern3 = /(^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-\.]+?\.[a-zA-Z]{2,6}$)/gim;
	//replacePattern3 = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

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
	if(textoUrl==="#no-link"){
		return false;
	}
	else if(textoUrl==="#"){
		return false;
	}
	else if(textoUrl==="#carousel-example-generic"){
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
			if(textoUrl.substr(textoUrl.length - 1, 1) === 's') { //Spanish case for 2 or more
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
function windowPopup(element){
	
    var leftPosition;
	var topPosition;
	var getUrl = $(element).data('win-url');
	var getSize = $(element).data('win-size').split('x');
	var getAlign = $(element).data('win-align').split(',');
	var getScroll = $(element).data('win-scroll');
	
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
		topPosition = (window.screen.height / 2) - ((getSize[0] / 2) + 50);//Allow for title and status bars.
	}
	
    //Open the window.
    window.open(getUrl,"WindowPopupJS","status=no,"+
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
}

//Map launch function
function mapLaunch(element){
	
	var mapContent;
	var mapTitle = "@maplaunch-title";
	var mapText = "@maplaunch-text";
	var mapIcon1 = mainUrl+"/css/icons/maplaunch/google-maps.png";
	var mapIcon2 = mainUrl+"/css/icons/maplaunch/waze.png";
	var mapCoords = $(element).data('map-coords').split(',');
	var mapAddress = $(element).data('map-address');
	var mapAddressUrl = encodeURI(mapAddress).replace(/%20/g,'+');
	var mapLaunchUrl1 = isMobile ? 'http://maps.google.com/maps?q='+mapCoords[0]+','+mapCoords[1]+','+mapCoords[2]+'z' : 
										   'https://www.google.cl/maps/search/'+mapAddressUrl+'/@'+mapCoords[0]+','+mapCoords[1]+','+mapCoords[2]+'z';
	var mapLaunchUrl2 = isMobile ? 'waze://?ll='+mapCoords[0]+','+mapCoords[1]+'&navigate=yes' : 
										   'https://www.waze.com/livemap?zoom='+mapCoords[2]+'&lat='+mapCoords[0]+'&lon='+mapCoords[1];
	
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
/* ================================================= FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */

	//Load Responsive Code
	responsiveCode();

	//Load LightGallery
	loadLightGallery();

	//Check home
	isHome = $(".isHome").length > 0 ? true : false;

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
	$("*[data-toggle='tooltip']").tooltip();
	
	//Popover load
	$("*[data-toggle='popover']").popover();

	//Apply Auto Background
	$("*[data-auto-bg]").each(function(){
		autoBackground($(this));
	});
	
	//Touch swipe bootstrap carousel
	$("*[data-ride='carousel']").swipe({
		swipe:function(event, direction, distance, duration, fingerCount, fingerData){
				if(direction === "right"){
					$(this).carousel('prev');  
				}
				else if(direction === "left"){
					$(this).carousel('next');  
				}
			}
	});
	
	//Applu Data Tables
	$('.JSdataTables').each(function(){
		$(this).DataTable({
			paging: toBoolean($(this).data('table-pages')),
			searching: toBoolean($(this).data('table-search')),
			info: toBoolean($(this).data('table-info')),
			ordering: toBoolean($(this).data('table-sort')),
		});
	});
	
	//Apply Text Cur
	$(".JStextCut").each(function(){
		textCut($(this));
	});
	
	//Map Launch on click
	$(document).on("click", ".JSwindowPopup", function(){
		windowPopup($(this));
	});
	
	//Map Launch on click
	$(document).on("click", ".JSmapLaunch", function(){
		mapLaunch($(this));
	});
	
	//Modal on disabled links
	$(document).on("click", "a[href*=#]", function(){
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