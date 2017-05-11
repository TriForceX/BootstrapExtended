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
	
	//Form validation
	$(".JSformExample").validateForm({
		noValidate: "#example-input-lastname",
		searchMode: false,
	});
	
	//Form validation
	$(".JSformExampleSearch").validateForm({
		noValidate: "#example-input-lastname",
		searchMode: true,
	});
	
/* ================================================= DOCUMENT READY ================================================= */

});