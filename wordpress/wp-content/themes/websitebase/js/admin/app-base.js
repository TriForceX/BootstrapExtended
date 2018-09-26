/* ================================================= THEME FUNCTIONS ================================================= */



/* ================================================= THEME FUNCTIONS ================================================= */

jQuery(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */
	
	//Lock admin bar buttons
	jQuery('#wpadminbar #wp-admin-bar-site-name > .ab-item').click(function(e){
		e.preventDefault();
	});
	jQuery('#wpadminbar #wp-admin-bar-new-content > .ab-item').click(function(e){
		e.preventDefault();
	});
	
	//Replace admin bar buttons
	jQuery('#wpadminbar #wp-admin-bar-view-site').find('a').attr('target','_blank');
	
	//Action for custom multiple checkbox control in theme customize
	jQuery(document).on('click','.wp-core-ui .customize-control-checkbox-multiple input[type="checkbox"]',function(){

		var checkbox_values = jQuery(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(function(){
							  		return this.value;
							  }).get().join(',');

		jQuery(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');
	});
	
/* ================================================= DOCUMENT READY ================================================= */

});

jQuery(window).bind("load", function(){

/* ================================================= THEME WINDOWS LOAD ================================================= */
	
	
	
/* ================================================= THEME WINDOWS LOAD ================================================= */

});

jQuery(document).ajaxStart(function(){

/* ================================================= THEME AJAX START ================================================= */
	
	
	
/* ================================================= THEME AJAX START ================================================= */

});

jQuery(document).ajaxComplete(function(){

/* ================================================= THEME AJAX COMPLETE ================================================= */
	
	
	
/* ================================================= THEME AJAX COMPLETE ================================================= */

});
