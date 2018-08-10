/* ================================================= BASE FUNCTIONS ================================================= */

//Global variables
var mainUrl = '@global-url';
var isLang = mainLang;
var isHome;
var isMobile;
var isNav;
var checkDisabled = $('body').data('js-check-disabled');
var checkDisabledExceptions = ['#carousel'];
var checkDisabledAlignment = ['medium','top'];

//IE8 Undefined console fix
if (!window.console) console = {log: function() {}};

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
		errorStyling	: true,
		modalSize		: 'medium',
		modalAlign		: '',
	}, options);
	
	$(this).submit(function(event){ 
		
		var formError = false;
		var formConfirmTitle = lang('@validate-confirm-title');
		var formConfirmText = lang('@validate-confirm-text');
		var formErrorTitle = lang('@validate-title');
		var formErrorText = {
							 'text'		: lang('@validate-normal'), 
							 'number'	: lang('@validate-number'), 
							 'tel'		: lang('@validate-tel'), 
							 'pass'		: lang('@validate-pass'), 
							 'email'	: lang('@validate-email'),
							 'search'	: lang('@validate-search'),
							 'checkbox'	: lang('@validate-checkbox'),
							 'radio'	: lang('@validate-radio'),
							 'textarea'	: lang('@validate-textarea'),
							 'select'	: lang('@validate-select'),
							 'file'		: lang('@validate-file'),
							};
		
		var formInputValidation = function(element){
			switch(element.attr("type")){
				case 'text':
					if (!validateEmpty(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.text;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'number':
					if (!validateEmpty(element.val()) || !validateNumber(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.number;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'tel':
					if (!validateEmpty(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.tel;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'email':
					if (!validateEmpty(element.val()) || !validateEmail(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.email;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'password':
					if (!validateEmpty(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.pass;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'search':
					if (!validateEmpty(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.search;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				case 'file':
					if (!validateEmpty(element.val())) { 
						if(settings.errorStyling){ element.parents('.form-group').addClass('has-error').removeClass('has-success'); }
						formError = formErrorText.file;
					}
					else{
						if(settings.errorStyling){ element.parents('.form-group').removeClass('has-error').addClass('has-success'); }
					}
					break;
				default: break;
			}
		};

		//Select inputs
		$(this).find('select').not(settings.noValidate).each(function(){
			if (!validateEmpty($(this).find("option:selected").attr("value"))) { 
				if(settings.errorStyling){ $(this).parents('.form-group').addClass('has-error').removeClass('has-success'); }
				formError = formErrorText.select;
			}
			else{
				if(settings.errorStyling){ $(this).parents('.form-group').removeClass('has-error').addClass('has-success'); }
			}
		});
		
		//Textarea inputs
		$(this).find('textarea').not(settings.noValidate).each(function(){
			if (!validateEmpty($.trim($(this).val()))) { 
				if(settings.errorStyling){ $(this).parents('.form-group').addClass('has-error').removeClass('has-success'); }
				formError = formErrorText.textarea;
			}
			else{
				if(settings.errorStyling){ $(this).parents('.form-group').removeClass('has-error').addClass('has-success'); }
			}
		});
		
		//Checkbox & radio group inputs
		$(this).find('[data-group="checkbox"], [data-group="radio"]').not(settings.noValidate).each(function(){
			var type = $(this).data('group');
			var item = $(this).find('input[type="'+type+'"]');
			var check = false;
		
			for (var i = item.length -1; i >= 0; i--){
				if(item.eq(i).is(":checked")){
					check = true;
				}
			}
			if(!check){
				if(settings.errorStyling){ item.parents('.form-group').addClass('has-error').removeClass('has-success'); }
				formError = formErrorText[type];
			}
			else{
				if(settings.errorStyling){ item.parents('.form-group').removeClass('has-error').addClass('has-success'); }
			}
		});
		
		//Checkbox & radio input addons
		$(this).find('[data-group="checkbox-addon"], [data-group="radio-addon"]').not(settings.noValidate).each(function(){
			var type = $(this).data('group').replace(/-addon/g,'');
			var item = $(this).find('input[type="'+type+'"]');
			var check = false;
		
			for (var i = item.length -1; i >= 0; i--){
				if(item.eq(i).is(":checked")){
					check = true;
				}
			}
			if(!check){
				if(settings.errorStyling){ item.parents('.form-group').addClass('has-error').removeClass('has-success'); }
				formError = formErrorText[type];
			}
			else{
				$(this).find('input[type="'+type+'"]:checked').parents('.input-group').find('input').each(function(){
					formInputValidation($(this));
				});
			}
		});
		
		//Input validation
		$(this).find('.form-group').not('[data-group="checkbox-addon"], [data-group="radio-addon"]').find('input').not(settings.noValidate).each(function(){
			formInputValidation($(this));
		});
		
		//Custom validation
		if(settings.customValidate !== null){
			var CVFunction = settings.customValidate[0];
			var CVInput = settings.customValidate[1];
			var CVMessage = settings.customValidate[2];
			
			$(CVInput).each(function(){
				if (!window[CVFunction]($(this).val())) { 
					if(settings.errorStyling){ $(this).parents('.form-group').addClass('has-error').removeClass('has-success'); }
					formError = CVMessage;
				}
				else{
					if(settings.errorStyling){ $(this).parents('.form-group').removeClass('has-error').addClass('has-success'); }
				}
			});
		}
		
		//Send error
		if(formError !== false)
		{
			//Check plugin
			if(typeof bootbox !== 'undefined')
			{
				//Bootbox alert
				bootbox.alert({
					title: formErrorTitle,
					message: formError,
					size: settings.modalSize,
					backdrop: true,
					className: settings.modalAlign,
				});
			}
			event.preventDefault();
		}
		
		//Check Confirm mode
		if(settings.hasConfirm && formError === false)
		{
			var formElement = $(this);
			event.preventDefault();
			
			//Check plugin
			if(typeof bootbox !== 'undefined')
			{
				//Bootbox alert
				bootbox.confirm({
					title: formConfirmTitle,
					message: formConfirmText,
					size: settings.modalSize,
					backdrop: true,
					className: settings.modalAlign,
					callback: function(result){
						if(result){
							formElement.unbind("submit").submit();
							if(settings.resetSubmit){
								formElement.trigger('reset');
								if(settings.errorStyling){ formElement.find('.form-group').removeClass('has-error'); }
								if(settings.errorStyling){ formElement.find('.form-group').removeClass('has-warning'); }
								if(settings.errorStyling){ formElement.find('.form-group').removeClass('has-success'); }
								formElement.find('input[type="checkbox"]').prop('checked', false).parent().removeClass('active');
								formElement.find('input[type="radio"]').prop('checked', false).parent().removeClass('active');
								formElement.find('.form-group input[type="file"]').each(function(){
									var placeholder = $(this).hasAttr('placeholder') ? $(this).attr('placeholder') : '';
									$(this).parent().find('.custom-file-text > span').html(placeholder);
								});
							}
							formElement.validateForm({
								noValidate: settings.noValidate,
								hasConfirm: settings.hasConfirm,
							});
						}
					}
				});
			}
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

//Get max width between elements
function getMaxWidth(elems, getrect)
{
    return Math.max.apply(null, elems.map(function()
    {
		if(getrect === true){
			return $(this).outerWidth2();
		}
		else{
			return $(this).outerWidth();
		}
    }).get());
}

//Get max height between elements
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
	var bodyScreen = {'xs'	: '@screen-xs', //480
					  'sm'	: '@screen-sm', //768
					  'md'	: '@screen-md', //992
					  'lg'	: '@screen-lg', //1200
					  'xl'	: '@screen-xl'}; //1920

	if (bodyWidth)
	{
		/* Responsive Changes */

		//Send data to event
		$(document).trigger("responsiveCode", [bodyWidth, bodyHeight, bodyOrientation, bodyScreen]);
		
		/* Responsive Changes */
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
		var galPageTotal = parseInt($(this).data("lg-page-total"));
		var galGalleryMode = $(this).data("lg-gallery");
		var galPageCurrent = parseInt($(this).data("lg-page-current"));
		var galLoadThumb = mainUrl+"/resources/lightgallery/img/loading.gif";
		
		if(String($(this).data("lg-title")) != "auto"){
			$(this).find(galSelectorVal).not(".lg-thumb-prev, .lg-thumb-next").attr("title", $(this).data("lg-title"));
		}
		
		if(toBoolean(galGalleryMode) === true){
			$(this).addClass("JSlightGalleryMode");
		}
		
		if($(".JSlightGalleryMode").length > 0 && galPageTotal > 1){
			if($(".JSlightGallery.JSlightGalleryMode .lg-thumb-prev").length < 1 && 
			   $(".JSlightGallery.JSlightGalleryMode .lg-thumb-next").length < 1){
				$(".JSlightGallery.JSlightGalleryMode").prepend("<div class='lg-thumb-prev' href='"+galLoadThumb+"' title='"+lang('@lgtitle-prev-text')+"'><img src='#'></div>");
				$(".JSlightGallery.JSlightGalleryMode").append("<div class='lg-thumb-next' href='"+galLoadThumb+"' title='"+lang('@lgtitle-next-text')+"'><img src='#'></div>");
			}
		}
		
		$(this).lightGallery({
			selector: galSelectorVal+", .lg-thumb-prev, .lg-thumb-next", 
			thumbnail: toBoolean(galThumbnailVal),
			download: toBoolean(galDownloadVal),
			hash: toBoolean(galGalleryMode) === true ? false : true,
			loop: false,
		}); 
		
		if($(".JSlightGalleryMode").length > 0 && galPageTotal > 1){
			
			var total;
			var totalSlide;
			var current;
			var currentSlide;
			
			$(".JSlightGallery.JSlightGalleryMode").on('onBeforeOpen.lg',function(){
				$("#lg-counter").addClass("invisible");
			});
			
			$(".JSlightGallery.JSlightGalleryMode").on('onBeforeSlide.lg',function(){
				$("#lg-counter").addClass("invisible");
			});
			
			$(".JSlightGallery.JSlightGalleryMode").on('onAfterOpen.lg',function(){
				var galThumbPrevHTML = "<div><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span><strong>"+lang('@lgtitle-prev-button')+"</strong></div>";
				var galThumbNextHTML = "<div><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span><strong>"+lang('@lgtitle-next-button')+"</strong></div>";
				
				$(".lg-outer .lg-thumb .lg-thumb-item:first-child").addClass("JSlightGalleryNoBorder").append(galThumbPrevHTML);
				$(".lg-outer .lg-thumb .lg-thumb-item:last-child").addClass("JSlightGalleryNoBorder").append(galThumbNextHTML);
				
				total = parseInt($("#lg-counter-all").html());
				totalSlide = total <= 2 ? 1 : (total - 2);
				current = parseInt($("#lg-counter-current").html());
				currentSlide = current <= 2 ? 1 : (current == total ? totalSlide : (current - 1));
				
				$("#lg-counter-all").html(totalSlide);
				$("#lg-counter-current").html(currentSlide);
				$("#lg-counter").removeClass("invisible");
				
				//Prev & Next Pages
				if(galPageCurrent === 1){
					$(".lg-outer .lg-thumb .lg-thumb-item:first-child").addClass("invisible");
					$(".lg-outer .lg-thumb .lg-thumb-item:last-child").removeClass("invisible");
				}
				else if(galPageCurrent === galPageTotal){
					$(".lg-outer .lg-thumb .lg-thumb-item:first-child").removeClass("invisible");
					$(".lg-outer .lg-thumb .lg-thumb-item:last-child").addClass("invisible");
				}
				else{
					$(".lg-outer .lg-thumb .lg-thumb-item:first-child").removeClass("invisible");
					$(".lg-outer .lg-thumb .lg-thumb-item:last-child").removeClass("invisible");
				}
				
				//Prev & Next Controls
				if(currentSlide === 1){
					$(".lg-actions .lg-prev").addClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
				}
				else if(currentSlide > 1 && currentSlide < totalSlide){
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
				}
				else if(currentSlide >= totalSlide){
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").addClass("invisible");
				}
				else{
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
				}
			});
			
			$(".JSlightGallery.JSlightGalleryMode").on('onAfterSlide.lg',function(){
				current = parseInt($("#lg-counter-current").html());
				currentSlide = current <= 2 ? 1 : (current == total ? totalSlide : (current - 1));
				
				$("#lg-counter-all").html(totalSlide);
				$("#lg-counter-current").html(currentSlide);
				$("#lg-counter").removeClass("invisible");
				
				//Prev & Next Controls
				if(currentSlide === 1){
					$(".lg-actions .lg-prev").addClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
					//Close
					if(current === 1){
						if(galPageCurrent === 1){
							$(".lg-outer .lg-sub-html").html(lang('@lgtitle-gallery-close'));
						}
						else{
							//Redirect
							$(".JSlightGallery").addClass("lightGalleryAuto");
							$(".JSlightGallery").addClass("lightGalleryAutoPrev");
						}
						setTimeout(function(){ $(".lg-toolbar .lg-close").trigger("click"); }, 1500);
					}
				}
				else if(currentSlide > 1 && currentSlide < totalSlide){
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
				}
				else if(currentSlide >= totalSlide){
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").addClass("invisible");
					//Close
					if(current === total){
						if(galPageCurrent === galPageTotal){
							$(".lg-outer .lg-sub-html").html(lang('@lgtitle-gallery-close'));
						}
						else{
							//Redirect
							$(".JSlightGallery").addClass("lightGalleryAuto");
							$(".JSlightGallery").addClass("lightGalleryAutoNext");
						}
						setTimeout(function(){ $(".lg-toolbar .lg-close").trigger("click"); }, 1500);
					}
				}
				else{
					$(".lg-actions .lg-prev").removeClass("invisible");
					$(".lg-actions .lg-next").removeClass("invisible");
				}
			});
			
			$(".JSlightGallery.JSlightGalleryMode").on('onCloseAfter.lg',function(){
				if($(this).hasClass("lightGalleryAuto")){
					if($(this).hasClass("lightGalleryAutoNext")){
						//Stuff to do on close
						$(document).trigger("onNextPageChange.lg"); //Send data to event
					}
					else if($(this).hasClass("lightGalleryAutoPrev")){
						//Stuff to do on close
						$(document).trigger("onPrevPageChange.lg"); //Send data to event
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
function showAlert(title, text, size, align)
{
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	if(align === undefined || align === null || align == ''){  //Empty value
		align = '';
	}
	
	//Check plugin
	if(typeof bootbox !== 'undefined')
	{
		//Bootbox alert
		bootbox.alert({
			title: title,
			message: text,
			size: size,
			backdrop: true,
			className: align,
		});
	}
}

//Show alert modal box using BootBox plugin (Content)
function showContent(title, element, size, align)
{
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	if(align === undefined || align === null || align == ''){  //Empty value
		align = '';
	}
	
	//Check plugin
	if(typeof bootbox !== 'undefined')
	{
		//Bootbox alert
		bootbox.alert({
			title: title,
			message: $(element).html(),
			size: size,
			backdrop: true,
			className: align,
		});
	}
}

//Show alert modal box using BootBox plugin (Ajax)
function showAjax(title, fullurl, size, align, loading, debug)
{
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	if(align === undefined || align === null || align == ''){  //Empty value
		align = '';
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
			//Check plugin
			if(typeof bootbox !== 'undefined')
			{
				//Bootbox alert
				bootbox.alert({
					title: title,
					message: data,
					size: size,
					backdrop: true,
					className: align,
				});
			}
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
function videoLaunch(url, share, title, autoplay, size, align)
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
	
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'large';
	}
	
	if(align === undefined || align === null || align == ''){  //Empty value
		align = '';
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
	
	//Check plugin
	if(typeof bootbox !== 'undefined')
	{
		bootbox.alert({
			title: title,
			message: content,
			size: size,
			backdrop: true,
			className: align,
		}).on("shown.bs.modal", function(){
			//Modify facebook src
			if (url.indexOf('facebook') >= 0){
				var videoLaunchIframeSRC = $(".JSvideoLaunchIframe iframe").attr("src");
				var videoLaunchIframeSRCwidth = $(".JSvideoLaunchIframe iframe").width();
				var videoLaunchIframeSRCheight = $(".JSvideoLaunchIframe iframe").height();
				$(".JSvideoLaunchIframe iframe").attr("src",videoLaunchIframeSRC+"&width="+videoLaunchIframeSRCwidth+"&height="+videoLaunchIframeSRCheight);
			}
		});
	}

	//Tooltip load
	$('.JSvideoLaunchText').tooltip({
		title: embedShareText,
		placement: 'bottom',
		trigger: 'manual',
	});

	//Check plugin
	if(typeof ClipboardJS !== 'undefined')
	{
		//Clipboard
		var clipboard = new ClipboardJS('.JSvideoLaunchURL');

		clipboard.on('success', function(){
			$('.JSvideoLaunchText').tooltip('show');
		});

		clipboard.on('error', function(){
			$('.JSvideoLaunchURL').attr('target','blank');
			$('.JSvideoLaunchURL').attr('href',embedShare);
		});
	}
	else
	{
		$('.JSvideoLaunchURL').attr('target','blank');
		$('.JSvideoLaunchURL').attr('href',embedShare);
	}
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
	var size = checkDisabledAlignment[0];
	var align = checkDisabledAlignment[1];
	
	if(size === undefined || size === null || size == ''){  //Empty value
		size = 'medium';
	}
	
	if(align === undefined || align === null || align == ''){  //Empty value
		align = '';
	}
	
	//Exception 1
	for (var i = exceptions.length - 1; i >= 0; --i){
		if (textUrl.indexOf(exceptions[i]) != -1){
			return true;
		}
	}

	//Exception 2
	if(textUrl === '#' || textUrl.split('#')[1] == ''){
		return false;
	}
	else{
		if(textUrl.indexOf(window.location.host) <= 0){
			//Show alert
			var section = textUrl.split('#')[1].replace(/-/g,' ');
			//Check plugin
			if(typeof bootbox !== 'undefined')
			{
				//Bootbox alert
				bootbox.alert({
					title: section,
					message: lang('@disabled-text'),
					size: size,
					backdrop: true,
					className: align,
				});
			}
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
	var getModalSize = $(element).data('win-modal-size');
	var getModalAlign = $(element).data('win-modal-align');
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent);
	
	if(getModalSize === undefined || getModalSize === null || getModalSize == ''){  //Empty value
		getModalSize = 'small';
	}
	
	if(getModalAlign === undefined || getModalAlign === null || getModalAlign == ''){  //Empty value
		getModalAlign = '';
	}
	
	//Horizontal Align
	if(getAlign[0]==="right"){
		leftPosition = window.screen.width;
	}
	else if(getAlign[0]==="left"){
		leftPosition = 0;
	}
	else{
		leftPosition = (window.screen.width / 2) - ((getSize[0] / 2) + 10); //Allow for borders.
	}

	//Vertical Align
	if(getAlign[1]==="top"){
		topPosition = 0;
	}
	else if(getAlign[1]==="bottom"){
		topPosition = window.screen.height;
	}
	else{
		topPosition = (window.screen.height / 2) - ((getSize[1] / 2) + 50); //Allow for title and status bars.
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
		//Check plugin
		if(typeof bootbox !== 'undefined')
		{
			//Bootbox alert
			bootbox.alert({
				title: errortitle,
				message: errormsg,
				size: getModalSize,
				backdrop: true,
				className: getModalAlign,
			});
		}
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
	var mapIframe = toBoolean($(element).data('map-iframe'));
	var mapModalSize = $(element).data('map-modal-size');
	var mapModalAlign = $(element).data('map-modal-align');
	var mapAddress = $(element).data('map-address');
	var mapAddressUrl = encodeURI(mapAddress).replace(/%20/g,'+');
	var mapLaunchUrl1 = isMobile ? 'https://maps.google.com/maps?q='+mapCoords1[0]+','+mapCoords1[1]+','+mapCoords1[2]+'z' : 
										   'https://www.google.com/maps/search/'+mapAddressUrl+'/@'+mapCoords1[0]+','+mapCoords1[1]+','+mapCoords1[2]+'z';
	var mapLaunchUrl2 = isMobile ? 'waze://?ll='+mapCoords2[0]+','+mapCoords2[1]+'&navigate=yes' : 
										   'https://www.waze.com/livemap?zoom='+mapCoords2[2]+'&lat='+mapCoords2[0]+'&lon='+mapCoords2[1];
	
	if(mapIframe === undefined || mapIframe === null || mapIframe == ''){  //Empty value
		mapIframe = false;
	}
	
	if(mapModalSize === undefined || mapModalSize === null || mapModalSize == ''){  //Empty value
		mapModalSize = mapIframe == false ? 'small' : 'medium';
	}
	
	if(mapModalAlign === undefined || mapModalAlign === null || mapModalAlign == ''){  //Empty value
		mapModalAlign = '';
	}
	
	mapContentStyle1 = '<div class="JSmapLaunchInfo">'+
						'	<span class="label label-primary">'+mapText+'</span>'+
						'	<div class="JSmapLaunchIcons">'+
						'		<a href="'+mapLaunchUrl1+'" target="_blank">'+
						'			<img src="'+mapIcon1+'">'+
						'		</a>'+
						'		<a class="JSmapLaunchAlert" href="'+mapLaunchUrl2+'" target="_blank">'+
						'			<img src="'+mapIcon2+'">'+
						'		</a>'+
						'	</div>'+
						'	<div class="well mb-0 mt-3">'+mapAddress+'</div>'+
						'</div>';
	
	mapContentStyle2 = '<div class="JSmapLaunchInfo">'+
						'	<div class="well mb-4">'+mapAddress+'</div>'+
						'	<div class="JSmapLaunchIframe embed-responsive embed-responsive-16by9">'+
						'		<iframe class="embed-responsive-item" src="https://maps.google.com/maps?q='+mapAddressUrl+'&z='+mapCoords1[2]+'&output=embed" frameborder="0" allowfullscreen></iframe>'+
						'	</div>'+
						'	<span class="label label-primary">'+mapText+'</span>'+
						'	<div class="JSmapLaunchIcons small">'+
						'		<a href="'+mapLaunchUrl1+'" target="_blank">'+
						'			<img src="'+mapIcon1+'">'+
						'		</a>'+
						'		<a class="JSmapLaunchAlert" href="'+mapLaunchUrl2+'" target="_blank">'+
						'			<img src="'+mapIcon2+'">'+
						'		</a>'+
						'	</div>'+
						'</div>';
	//Check plugin
	if(typeof bootbox !== 'undefined')
	{
		//Bootbox alert
		bootbox.alert({
			title: mapTitle,
			message: mapIframe == false ? mapContentStyle1 : mapContentStyle2,
			size: mapModalSize,
			backdrop: true,
			className: mapModalAlign,
		});
	}
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
	//Tooltip load
	$('*[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
	
	//Popover load
	$('*[data-toggle="popover"]').popover();
	
	//Check plugin
	if($.fn.lightGallery !== undefined)
	{
		//Load LightGallery
		loadLightGallery();
	}
	
	//Check plugin
	if($.fn.swipe !== undefined)
	{
		//Touch swipe Bootstrap carousel
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
	}
	
	//Check plugin
	if($.fn.dataTable !== undefined || $.fn.DataTable !== undefined)
	{
		//Applu Data Tables
		$('.JSdataTables').each(function(){
			$(this).dataTable().fnDestroy();
			$(this).DataTable({
					initComplete: function(settings,json){
						$(".dataTables_wrapper").removeClass("container-fluid");
					},
				}
			);
		});
	}
	
	//Check plugin
	if($.fn.timepicker !== undefined)
	{
		//Show on focus
		$(document).on("focusin", ".timepicker input", function(e){
			$(this).timepicker('showWidget');
		});
	}
	
	//Check plugin
	if($.fn.imgLiquid !== undefined)
	{
		//Apply Image Fill
		$('.JSimgFill').each(function(){
			imageFill($(this));
		});
	}
	
	//Apply Text Cut
	$(".JStextCut").each(function(){
		textCut($(this));
	});
	
	//Check plugin
	if($.fn.rotate !== undefined)
	{
		//Apply Rotation
		$(".JSrotate").each(function(){
			$(this).rotate({
				angle: $(this).data('rotate-angle')
			});
			$(this).css('visibility','visible');
		});
	}
	
	//Fix for Holder JS in IE8
	if(isNav('ie','8'))
	{
		$('img[data-src*="holder.js"]').each(function(){
			var src = $(this).data('src');
			var size = src.split('/');
			var getSize = size[1].split('x');
			var text = src.split('text=').pop().split('&').shift();
			var getText = text.replace(/ \\n /g,'<br>');
			var theme = src.split('theme=').pop().split('&').shift();
			var bg, fg;
			
			switch(theme){
	            case 'gray':
	                bg = '#EEEEEE';
	                fg = '#AAAAAA';
	            	break;
	            case 'social':
	                bg = '#3a5a97';
	                fg = '#FFFFFF';
	            	break;
	            case 'industrial':
	                bg = '#434A52';
	                fg = '#C2F200';
	            	break;
	            case 'sky':
	                bg = '#0D8FDB';
	                fg = '#FFFFFF';
	            	break;
	            case 'vine':
	                bg = '#39DBAC';
	                fg = '#1E292C';
	            	break;
	            case 'lava':
	                bg = '#F8591A';
	                fg = '#1C2846';
	            	break;
				default:
	                bg = '#777777';
	                fg = '#555555';
	            	break;
	        }
			
			$(this).css({
						'visibility':'hidden',
						'width':getSize[0].replace(/p/g,''),
						'height':getSize[1].replace(/p/g,''),
						});
			
			var fakeImage = '<div class="d-table position-absolute w-100 h-100" style="background-color: '+bg+'; color: '+fg+'; top: 0px; font-size: 45px; font-weight: bold">'+
							'	<div class="d-table-cell align-middle text-center">'+getText+'</div>'+
							'</div>';
			
			$(this).wrapAll('<div class="d-inline-block"></div>').after(fakeImage);
		});
	}
}
/* ================================================= BASE FUNCTIONS ================================================= */

$(document).ready(function(){

/* ================================================= BASE DOCUMENT READY ================================================= */
	
	//Check home
	isHome = $('.JSisHome').length > 0 ? true : false;

	//Check mobile
	isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|BB10|PlayBook|MeeGo/i.test(navigator.userAgent);
	
	
	//Check navigators
	isNav = function(name,version)
			{
				//Check plugin
				if($.fn.browser !== undefined)
				{
					var checkData = {
									 'ie' 			: { 'name' : 'Microsoft Internet Explorer', 'internal' : $.browser.msie },
									 'edge' 		: { 'name' : 'Microsoft Edge', 'internal' : '' },
									 'chrome' 		: { 'name' : 'Chrome', 'internal' : $.browser.webkit },
									 'firefox' 		: { 'name' : 'Firefox', 'internal' : $.browser.mozilla },
									 'safari' 		: { 'name' : 'Safari', 'internal' : $.browser.webkit },
									 'opera' 		: { 'name' : 'Opera', 'internal' : $.browser.opera },
									};

					var checkBrowser = $.browser.name === checkData[name].name;
					var checkVersion = version === undefined ? true : ($.browser.version == version);
					var checkInternal = checkData[name].internal === undefined ? true : (checkData[name].internal === true);
					var checkFinal = checkBrowser && checkVersion && checkInternal ? true : false;
					
					return checkFinal;
				}
			};
	
	//Disable button auto-focus
	$(document).on("shown.bs.modal", function(){
		$(".modal .modal-footer .btn:focus").blur();
		$(".modal").scrollTop(0);
	});
	
	//Window Popup click
	$(document).on("click", ".JSwindowPopup", function(){
		windowPopup($(this));
	});
	
	//Map Launch click
	$(document).on("click", ".JSmapLaunch", function(){
		mapLaunch($(this));
	});
	
	//Check map launch alert
	$(document).on("click", ".JSmapLaunchAlert", function(e){
		if (isMobile && !confirm(lang('@maplaunch-alert'))){
		  e.preventDefault();
		}
    });
	
	//Modal on disabled links
	if(!checkDisabled)
	{
		$(document).on("click", "a[href*=\\#]", function(e){
			var source =  $(this).attr("href");
			if(!(checkDisabledLink(source))){
				e.preventDefault();
			}
		});
	}
	
	//Custom file input change
	$(document).on("change", ".form-group .custom-file input[type='file']", function(){
		var placeholder = $(this).hasAttr('placeholder') ? $(this).attr('placeholder') : '';
		var filename = $(this)[0].files.length ? $(this)[0].files[0].name : placeholder;
		$(this).parent().find('.custom-file-text > span').html(filename);
	});
	
	//Check form reset
	$(document).on("reset", "form", function(e){
		$(this).find('.form-group').removeClass('has-error');
		$(this).find('.form-group').removeClass('has-warning');
		$(this).find('.form-group').removeClass('has-success');
		$(this).find('.form-group input[type="checkbox"]').prop('checked', false).parent().removeClass('active');
		$(this).find('.form-group input[type="radio"]').prop('checked', false).parent().removeClass('active');
		$(this).find('.form-group input[type="file"]').each(function(){
			var placeholder = $(this).hasAttr('placeholder') ? $(this).attr('placeholder') : '';
			$(this).parent().find('.custom-file-text > span').html(placeholder);
		});
    });
	
	//Load responsive code
	responsiveCode();
	
	//Launch main functions
	mainInit();
	
/* ================================================= BASE DOCUMENT READY ================================================= */

});

$(window).bind("load", function(){

/* ================================================= BASE WINDOWS LOAD ================================================= */
	
	
	
/* ================================================= BASE WINDOWS LOAD ================================================= */

});

$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){

/* ================================================= BASE RESPONSIVE CODE ================================================= */
	
	//Apply Text Size
	$(".JStextSize").each(function(){
		$(this).removeAttr('style');
		textSize($(this), $(this).css('font-size'));
	});
	
/* ================================================= BASE RESPONSIVE CODE ================================================= */

});

$(document).ajaxStart(function(){

/* ================================================= BASE AJAX START ================================================= */
	
	
	
/* ================================================= BASE AJAX START ================================================= */

});

$(document).ajaxComplete(function(){

/* ================================================= BASE AJAX COMPLETE ================================================= */
	
	mainInit();
	
/* ================================================= BASE AJAX COMPLETE ================================================= */

});
