$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */

	//Example lightGallery next page
	$(document).on("onNextPageChange.lg", function(event){
		window.location.href = $(".lg-next").attr("href"); 
	});
	
	//Example lightGallery prev page
	$(document).on("onPrevPageChange.lg", function(event){
		window.location.href = $(".lg-prev").attr("href");
	});
	
	//Scroll to gallery page
	if (getUrlParameter('page')){
		autoScroll(".JSlightGallery",true,0);
	}
	
	//Form validation
	$(".JSformExample").validateForm({
		noValidate: "#example-input-lastname",
		hasConfirm: true,
	});
	
/* ================================================= DOCUMENT READY ================================================= */

});