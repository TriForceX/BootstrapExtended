jQuery(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */
	
	//Lock admin bar buttons
	jQuery("#wp-admin-bar-site-name > .ab-item").click(function(e){
		e.preventDefault();
	});
	jQuery("#wp-admin-bar-new-content > .ab-item").click(function(e){
		e.preventDefault();
	});
	
	//Replace admin bar buttons
	jQuery("#wp-admin-bar-view-site").find("a").attr("target","_blank");
	
	//Remove Easy Gallery Plugin Select
	jQuery(".form-table td select[name='easy-image-gallery[lightbox]']").parent().parent().addClass("hidden");
	
/* ================================================= DOCUMENT READY ================================================= */

});